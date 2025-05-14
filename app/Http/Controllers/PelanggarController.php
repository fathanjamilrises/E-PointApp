<?php

namespace App\Http\Controllers;

use App\Models\DetailPelanggaran;
use App\Models\Pelanggar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PelanggarController extends Controller
{
    /**
     * Tampilkan daftar pelanggar.
     */
    public function index(): View
    {
        $id_pelanggars = DB::table('pelanggars')->pluck('id_siswa')->toArray();

        $pelanggars = DB::table('pelanggars')
            ->join('siswas', 'pelanggars.id_siswa', '=', 'siswas.id')
            ->join('users', 'siswas.id_user', '=', 'users.id')
            ->select('pelanggars.*', 'siswas.image', 'siswas.nis', 'siswas.tingkatan', 'siswas.jurusan', 'siswas.kelas', 'siswas.hp', 'users.name', 'users.email')
            ->whereIn('siswas.id', $id_pelanggars)
            ->latest()
            ->paginate(10);

        if (request('cari')) {
            $pelanggars = $this->searchPelanggar(request('cari'), $id_pelanggars);
        }

        return view('admin.pelanggar.index', compact('pelanggars'));
    }

    /**
     * Fungsi pencarian pelanggar berdasarkan nama/nis.
     */
    public function searchPelanggar(string $cari, $id)
    {
        return DB::table('pelanggars')
            ->join('siswas', 'pelanggars.id_siswa', '=', 'siswas.id')
            ->join('users', 'siswas.id_user', '=', 'users.id')
            ->select('pelanggars.*', 'siswas.image', 'siswas.nis', 'siswas.tingkatan', 'siswas.jurusan', 'siswas.kelas', 'siswas.hp', 'users.name', 'users.email')
            ->whereIn('siswas.id', $id)
            ->where(function ($query) use ($cari) {
                $query->where('users.name', 'like', '%' . $cari . '%')
                      ->orWhere('siswas.nis', 'like', '%' . $cari . '%');
            })
            ->latest()
            ->paginate(10);
    }

    /**
     * Form pilih siswa untuk dijadikan pelanggar.
     */
    public function create(): View
    {
        $id_pelanggars = DB::table('pelanggars')->pluck('id_siswa')->toArray();

        $siswas = DB::table('siswas')
            ->join('users', 'siswas.id_user', '=', 'users.id')
            ->select('siswas.*', 'users.name', 'users.email')
            ->whereNotIn('siswas.id', $id_pelanggars)
            ->latest()
            ->paginate(10);

        if (request('cari')) {
            $siswas = $this->searchSiswa(request('cari'), $id_pelanggars);
        }

        return view('admin.pelanggar.create', compact('siswas'));
    }

    /**
     * Pencarian siswa untuk form create.
     */
    public function searchSiswa(string $cari, $id)
    {
        return DB::table('siswas')
            ->join('users', 'siswas.id_user', '=', 'users.id')
            ->select('siswas.*', 'users.name', 'users.email')
            ->whereNotIn('siswas.id', $id)
            ->where(function ($query) use ($cari) {
                $query->where('users.name', 'like', '%' . $cari . '%')
                      ->orWhere('siswas.nis', 'like', '%' . $cari . '%');
            })
            ->latest()
            ->paginate(10);
    }

    /**
     * Simpan pelanggar baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|integer'
        ]);

        $pelanggar = Pelanggar::create([
            'id_siswa' => $request->id_siswa,
            'poin_pelanggar' => 0,
            'status_pelanggar' => 0,
            'status' => 0
        ]);

        return redirect()->route('pelanggar.show', $pelanggar->id);
    }

    /**
     * Tampilkan detail pelanggar dan list pelanggaran.
     */
    public function show(string $id)
    {
        $pelanggar = DB::table('pelanggars')
            ->join('siswas', 'pelanggars.id_siswa', '=', 'siswas.id')
            ->join('users', 'siswas.id_user', '=', 'users.id')
            ->select('pelanggars.*', 'siswas.image', 'siswas.nis', 'siswas.tingkatan', 'siswas.jurusan', 'siswas.kelas', 'siswas.hp', 'users.name', 'users.email')
            ->where('pelanggars.id', $id)
            ->first();

        $pelanggarans = DB::table('pelanggarans')->latest()->paginate(10);

        if (request('cari')) {
            $pelanggarans = $this->searchPelanggaran(request('cari'));
        }

        $idUser = Auth::id();

        return view('admin.pelanggar.show', compact('pelanggar', 'pelanggarans', 'idUser'));
    }

    /**
     * Pencarian pelanggaran.
     */
    public function searchPelanggaran(string $cari)
    {
        return DB::table('pelanggarans')
            ->where(DB::raw('lower(jenis)'), 'like', '%' . strtolower($cari) . '%')
            ->paginate(10);
    }

    /**
     * Simpan data detail pelanggaran siswa.
     */
    public function storePelanggaran(Request $request)
    {
        $request->validate([
            'id_pelanggar' => 'required',
            'id_user' => 'required',
            'id_pelanggaran' => 'required',
        ]);

        DetailPelanggaran::create([
            'id_pelanggar' => $request->id_pelanggar,
            'id_user' => $request->id_user,
            'id_pelanggaran' => $request->id_pelanggaran,
            'status' => 0
        ]);

        $this->updatePoin($request->id_pelanggaran, $request->id_pelanggar);

        return redirect()->route('detailPelanggar.show', $request->id_pelanggar)
                         ->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Hitung dan update poin pelanggar.
     */
    private function updatePoin(string $id_pelanggaran, string $id_pelanggar)
    {
        $poin = $this->calculatedPoin($id_pelanggaran, $id_pelanggar);

        $datas = Pelanggar::findOrFail($id_pelanggar);
        $datas->update(['poin_pelanggar' => $poin]);

        $this->updateStatus($datas, $poin);
    }

    /**
     * Hitung total poin berdasarkan penambahan.
     */
    private function calculatedPoin(string $id_pelanggaran, string $id_pelanggar)
    {
        $poin_pelanggaran = DB::table('pelanggarans')->where('id', $id_pelanggaran)->value('poin');
        $poin_pelanggar = DB::table('pelanggars')->where('id', $id_pelanggar)->value('poin_pelanggar');

        return $poin_pelanggar + $poin_pelanggaran;
    }

    /**
     * Update status kategori pelanggar.
     */
    private function updateStatus($datas, string $poin)
    {
        $kategoriPelanggar = 0;

        if ($poin >= 15 && $poin < 20) $kategoriPelanggar = 1;
        elseif ($poin >= 20 && $poin < 30) $kategoriPelanggar = 2;
        elseif ($poin >= 30 && $poin < 40) $kategoriPelanggar = 3;
        elseif ($poin >= 40 && $poin < 50) $kategoriPelanggar = 4;
        elseif ($poin >= 50 && $poin < 100) $kategoriPelanggar = 5;
        elseif ($poin >= 100) $kategoriPelanggar = 6;

        if ($kategoriPelanggar > $datas->status_pelanggar && $datas->status == 0) {
            $datas->update([
                'status_pelanggar' => $kategoriPelanggar,
                'status' => 1
            ]);
        }
    }

    /**
     * Tindakan untuk siswa yang melampaui batas pelanggaran.
     */
    public function statusTindak($id)
    {
        $datas = Pelanggar::findOrFail($id);

        $pelanggar = DB::table('pelanggars')
            ->join('siswas', 'pelanggars.id_siswa', '=', 'siswas.id')
            ->join('users', 'siswas.id_user', '=', 'users.id')
            ->select('users.name')
            ->where('pelanggars.id', $id)
            ->first();

        $datas->update(['status' => 2]);

        return redirect()->route('pelanggar.index')->with(['success' => $pelanggar->name . ' Telah Ditindak']);
    }

    /**
     * Hapus pelanggar dan detail pelanggarannya.
     */
    public function destroy($id): RedirectResponse
    {
        $this->destroyPelanggaran($id);

        Pelanggar::findOrFail($id)->delete();

        return redirect()->route('pelanggar.index')->with(['success' => 'Data Berhasil Dihapus']);
    }

    /**
     * Hapus semua detail pelanggaran milik pelanggar.
     */
    private function destroyPelanggaran(string $id)
    {
        DB::table('detail_pelanggarans')->where('id_pelanggar', $id)->delete();
    }
}

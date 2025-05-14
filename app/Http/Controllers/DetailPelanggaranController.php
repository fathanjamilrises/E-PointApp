<?php

namespace App\Http\Controllers;

use App\Models\DetailPelanggaran;
use App\Models\Pelanggar;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPelanggaranController extends Controller
{
    /**
     * Menampilkan daftar detail pelanggaran untuk 1 pelanggar.
     */
    public function show(string $id): View
    {
        $details = DB::table('detail_pelanggarans')
            ->join('pelanggars', 'detail_pelanggarans.id_pelanggar', '=', 'pelanggars.id')
            ->join('pelanggarans', 'detail_pelanggarans.id_pelanggaran', '=', 'pelanggarans.id')
            ->join('users', 'detail_pelanggarans.id_user', '=', 'users.id')
            ->select(
                'detail_pelanggarans.*',
                'pelanggars.id_siswa',
                'pelanggars.poin_pelanggar',
                'pelanggarans.jenis',
                'pelanggarans.konsekuensi',
                'pelanggarans.poin',
                'users.name'
            )
            ->where('detail_pelanggarans.id_pelanggar', $id)
            ->latest()
            ->paginate(10);

        $pelanggar = DB::table('pelanggars')
            ->join('siswas', 'pelanggars.id_siswa', '=', 'siswas.id')
            ->join('users', 'siswas.id_user', '=', 'users.id')
            ->select(
                'pelanggars.*',
                'siswas.image',
                'siswas.nis',
                'siswas.tingkatan',
                'siswas.jurusan',
                'siswas.kelas',
                'siswas.hp',
                'users.name',
                'users.email'
            )
            ->where('pelanggars.id', $id)
            ->first();

        return view('admin.detail.show', compact('details', 'pelanggar'));
    }

    /**
     * Update status pelanggaran menjadi sudah diberi sanksi.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $datas = DetailPelanggaran::findOrFail($id);

        $datas->update([
            'status' => 1
        ]);

        return redirect()
            ->route('detailPelanggar.show', $datas->id_pelanggar)
            ->with(['success' => 'Siswa Telah Diberikan Sanksi']);
    }

    /**
     * Hapus data pelanggaran detail dan kurangi poin pelanggar.
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        // Kurangi poin dari pelanggar
        $this->deletePoin($request->id_pelanggar, $request->poin_pelanggaran);

        // Hapus data detail pelanggaran
        $post = DetailPelanggaran::findOrFail($id);
        $post->delete();

        return redirect()
            ->route('detailPelanggar.show', $request->id_pelanggar)
            ->with(['success' => 'Data Berhasil Dihapus']);
    }

    /**
     * Fungsi untuk mengurangi poin pelanggar jika detail pelanggaran dihapus.
     */
    private function deletePoin($id_pelanggar, $poin_pelanggaran)
    {
        $poin_pelanggar = Pelanggar::where('id', $id_pelanggar)->value('poin_pelanggar');
        $poin = $poin_pelanggar - $poin_pelanggaran;

        $pelanggar = Pelanggar::findOrFail($id_pelanggar);
        $pelanggar->update([
            'poin_pelanggar' => $poin
        ]);
    }
}

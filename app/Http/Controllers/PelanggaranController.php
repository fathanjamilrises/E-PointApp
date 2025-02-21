<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PelanggaranController extends Controller
{
    public function index(): View 
    {
        $pelanggarans = Pelanggaran::latest()->paginate(10);

        if(request('cari')){
            $pelanggarans = $this->search(request('cari'));
        }
        
        return view('admin.pelanggaran.index', compact('pelanggarans'));
    }

    public function create() 
    {
        return view('admin.pelanggaran.create');
    }

    public function store(Request $request) 
    {
       $request->validate([
            'jenis' => 'required|string|max:250',
            'konsekuensi' => 'required|string|max:250',
            'poin' => 'required',
        ]);

        Pelanggaran::create([
            'jenis' => $request->jenis,
            'konsekuensi' => $request->konsekuensi,
            'poin' => $request->poin
        ]);

        return redirect()->route('pelanggaran.index')->with(['success' => 'Data Berhasil Ditambahkan']);
    }

    public function search(string $cari){
        $pelanggarans = DB::table('pelanggarans')->where(DB::raw('lower(jenis)'), 'like', '%' . strtolower($cari) . '%')->paginate(10);

        return $pelanggarans;
    }

    public function edit(string $id):View{
        $pelanggaran = Pelanggaran::where('id', $id)->first();

        return view('admin.pelanggaran.edit', compact('pelanggaran'));
    }

    public function update (Request $request, $id):RedirectResponse
    {
        $validated = $request->validate([
            'jenis' => 'required|string|max:250',
            'konsekuensi' => 'required|string|max:250',
            'poin' => 'required',
        ]);

        $datas = Pelanggaran::findOrFail($id);

        $datas->update([
            'jenis' => $request->jenis,
            'konsekuensi' => $request->konsekuensi,
            'poin' => $request->poin
        ]);
        return redirect()->route('pelanggaran.index')->with(["success" => "Data kamu berhasil diupdate"]);
    }

    public function destroy(string $id):RedirectResponse{
        $post = Pelanggaran::findOrFail($id);
        
        $post->delete();

        return redirect()->route('pelanggaran.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}

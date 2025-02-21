<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LoginRegisterController extends Controller
{
    public function index() {
        $users = User::latest()->paginate(10);

        return view('admin.akun.index', compact('users'));
    }
    public function create () {
        return view ('admin.akun.create');
    }


     public function edit ($id) {
        $akun = User::findOrFail($id);
        return view ('admin.akun.edit', compact('akun'));
    }
    public function register() {
        return view('auth.register');
    }

     public function update (Request $request, $id):RedirectResponse
    {
        $validated = $request->validate ([
            'name' => 'required|string|max:250',
            'usertype' => 'required'
        ]);

        $datas = User::findOrFail($id);

        $datas->update([
            'name' => $request->name,
            'usertype' => $request->usertype
        ]);

        return redirect()->route('akun.edit', $id)->with(["success" => "Data kamu berhasil diupdate"]);
    }

    public function updateEmail (Request $request, $id):RedirectResponse
    {
        $validated = $request->validate ([
            'email' => 'required|string|max:250|unique:users',
        ]);

        $datas = User::findOrFail($id);

        $datas->update([
            'email' => $request->email,
        ]);

        return redirect()->route('akun.edit', $id)->with(["success" => "Email kamu berhasil diupdate"]);
    }

    public function updatePassword (Request $request, $id):RedirectResponse
    {
        $validated = $request->validate ([
            'password' => 'required|min:8|confirmed',
        ]);

        $datas = User::findOrFail($id);

        $datas->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('akun.edit', $id)->with(["success" => "Password kamu berhasil diupdate"]);
    }

    public function destroy($id): RedirectResponse {
        $siswa = DB::table('siswas')->where('id_user', $id)->value('id');

        if($siswa){
            $this->destroySiswa($siswa);
        }

        $post = User::findOrFail($id);
        $post->delete();

        return redirect()->route('akun.index')->with(['success' => 'Data Berhasil Dihapus']);
    }

    public function destroySiswa(string $id){
        $post = Siswa::findOrFail($id);
        Storage::disk('public')->delete('siswas/' . $post->image);
        $post->delete();
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|string|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'usertype' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => $request ->usertype
        ]);

        return redirect()->route('akun.index')->with(['success' => 'Data Berhasil Ditambahkan']);
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($request->user()->usertype == 'admin') {
                return redirect('admin/dashboard')->withSuccess("Kamu berhasil log in");
            }
        }

        return back()->withErrors([
            'email' => "Email kamu tidak terdaftar, silahkan coba lagi",
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->withSuccess("Kamu berhasil logout");
    }
}


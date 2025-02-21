<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>
 <a href="{{ route('admin.dashboard') }}">Menu Utama</a>
    <br>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <br>
    <form action="{{ route('logout') }}" id="logout-form" method="POST">
        @csrf
    </form>
    <br>
    <form action="" method="get">
        <label>Cari :</label>
        <input type="text" name="cari">
        <input type="submit" value="Cari">
    </form>
    <br>
    <a href="{{ route('akun.create')}}">Tambah User</a>

    @if(Session::has('success'))
    <div class="alert-alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif


    <table class="tabel">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        @forelse($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->usertype }}</td>
            @if ($user -> usertype == 'admin')
            <td>
                  <a href="{{route ('akun.edit', $user->id)}}" class="btn btn-primary">EDIT</a>
            </td>
            @else
            <td>
                @if ($user -> usertype == 'siswa')
                <form onsubmit="return confirm('Jika akun siswa dihapus maka data siswa juga akan dihapus, apakah anda yakin')" action="{{route('akun.destroy',$user->id)}}" method="POST">
                @else
                <form onsubmit="return confirm('Anda Yakin ?')" action="{{route('akun.destroy',$user->id)}}" method="POST">
                @endif
                <a href="{{route ('akun.edit', $user->id)}}" class="btn btn-primary">EDIT</a>
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
                </form>
            </td>
            @endif
        </tr>
        @empty
        <tr>
            <td>
                <p>Data Tidak Ditemukan</p>
            </td>
            <td>
                <a href="{{ route('akun.index') }}">Kembali</a>
            </td>
        </tr>
        @endforelse
    </table>
    {{ $users->links() }}
</body>
</html>
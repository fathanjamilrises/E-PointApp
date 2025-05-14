<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        h1 {
            margin-bottom: 15px;
        }

        a {
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
        }

        img {
            border-radius: 6px;
        }

        .btn {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-dark {
            background-color: #343a40;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h1>Data Siswa</h1>

    {{-- Navigasi --}}
    <a href="{{ route('admin.dashboard') }}">Menu Utama</a>
    <a href="{{ route('siswa.create') }}">+ Tambah Siswa</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    {{-- Form Pencarian --}}
    <form action="" method="GET" style="margin-top: 15px;">
        <label for="cari">Cari :</label>
        <input type="text" name="cari" id="cari" placeholder="Cari nama/NIS...">
        <input type="submit" value="Cari">
    </form>

    {{-- Notifikasi --}}
    @if(Session::has('success'))
        <div class="success">
            {{ Session::get('success') }}
        </div>
    @endif

    {{-- Tabel Siswa --}}
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswas as $siswa)
                <tr>
                    <td>
                        <img src="{{ asset('storage/public/siswas/' . $siswa->image) }}" width="100px" height="100px">
                    </td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->name }}</td>
                    <td>{{ $siswa->email }}</td>
                    <td>{{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa->kelas }}</td>
                    <td>{{ $siswa->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>{{ $siswa->hp }}</td>
                    <td>
                        <a href="{{ route('siswa.show', $siswa->id) }}" class="btn btn-dark">SHOW</a>
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-primary">EDIT</a>
                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">HAPUS</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Data tidak ditemukan. <a href="{{ route('siswa.index') }}">Kembali</a></td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div style="margin-top: 20px;">
        {{ $siswas->links() }}
    </div>

</body>
</html>

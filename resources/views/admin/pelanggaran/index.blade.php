<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pelanggaran</title>
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

        th,
        td {
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
    <h1>Data Pelanggaran</h1>

    <a href="{{ route('admin.dashboard') }}">Menu Utama</a>
    <br>
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
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
    <a href="{{ route('pelanggaran.create') }}">Tambah Pelanggaran</a>

    @if (Session::has('success'))
        <div class="success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="tabel">
        <tr>
            <th>Jenis</th>
            <th>Konsekuensi</th>
            <th>Poin</th>
            <th>Aksi</th>
        </tr>
        @forelse($pelanggarans as $pelanggaran)
            <tr>
                <td>{{ $pelanggaran->jenis }}</td>
                <td>{{ $pelanggaran->konsekuensi }}</td>
                <td>{{ $pelanggaran->poin }}</td>
                <td>
                    <form onsubmit="return confirm('Anda Yakin ?');"
                        action="{{ route('pelanggaran.destroy', $pelanggaran->id) }}"method="POST">
                        <a href="{{ route('pelanggaran.edit', $pelanggaran->id) }}" class="btn btn-primary">EDIT</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center;">
                    <p>Data Tidak Ditemukan</p>
                    <a href="{{ route('pelanggaran.index') }}">Kembali</a>
                </td>
            </tr>
        @endforelse
    </table>
    {{ $pelanggarans->links() }}
</body>

</html>

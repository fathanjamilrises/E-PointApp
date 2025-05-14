<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggar</title>
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

        .form-container {
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <h1>Data Pelanggar</h1>

    <a href="{{ route('admin.dashboard') }}">Menu Utama</a>
    <a href="{{ route('pelanggar.create') }}">+ Tambah Pelanggar</a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <form action="" method="GET" class="form-container">
        <label for="cari">Cari :</label>
        <input type="text" name="cari" id="cari" placeholder="Cari nama/NIS...">
        <input type="submit" value="Cari">
    </form>

    @if(Session::has('success'))
        <div class="success">
            {{ Session::get('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>No Hp</th>
                <th>Poin</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelanggars as $pelanggar)
                <tr>
                    <td>
                        <img src="{{ asset('storage/public/siswas/' . $pelanggar->image) }}" width="100px" height="100px">
                    </td>
                    <td>{{ $pelanggar->nis }}</td>
                    <td>{{ $pelanggar->name }}</td>
                    <td>{{ $pelanggar->tingkatan }} {{ $pelanggar->jurusan }} {{ $pelanggar->kelas }}</td>
                    <td>{{ $pelanggar->hp }}</td>
                    <td>{{ $pelanggar->poin_pelanggar }}</td>
                    <td>
                        @if ($pelanggar->status == 0)
                            Tidak Perlu Ditindak
                        @elseif($pelanggar->status == 1)
                            <form action="{{ route('pelanggar.statusTindak', $pelanggar->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Perlu Ditindak</button>
                            </form>
                        @elseif($pelanggar->status == 2)
                            Sudah Ditindak
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('detailPelanggar.show', $pelanggar->id) }}" class="btn btn-dark">Detail</a>
                        <form action="{{ route('pelanggar.destroy', $pelanggar->id) }}" method="POST" onsubmit="return confirm('Apakah Anda Yakin?');" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Data tidak ditemukan. <a href="{{ route('pelanggar.index') }}">Kembali</a></td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $pelanggars->links() }}
    </div>

</body>
</html>

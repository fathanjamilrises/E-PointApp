<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Pelanggar</title>
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
            margin: 20px 0px;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid;
            padding: 10px;
            text-align: left;
        }

        img {
            border-radius: 6px;
        }

        button,
        input[type="submit"] {
            padding: 6px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        h1 {
            margin-top: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>Detail Siswa</h1>
    <a href="{{ route('pelanggar.index') }}">Kembali</a>

    <table>
        <tr>
            <td colspan="4" style="text-align: center;">
                <img src="{{ asset('storage/public/siswas/' . $pelanggar->image) }}" width="120" height="120">
            </td>
        </tr>
        <tr>
            <th colspan="2">Akun Pelanggar</th>
            <th colspan="2">Data Pelanggar</th>
        </tr>
        <tr>
            <th>Nama</th>
            <td>: {{ $pelanggar->name }}</td>
            <th>NIS</th>
            <td>: {{ $pelanggar->nis }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>: {{ $pelanggar->email }}</td>
            <th>Kelas</th>
            <td>: {{ $pelanggar->tingkatan }} {{ $pelanggar->jurusan }} {{ $pelanggar->kelas }}</td>
        </tr>
        <tr>
            <th></th>
            <td></td>
            <th>No HP</th>
            <td>: {{ $pelanggar->hp }}</td>
        </tr>
        <tr>
            <th></th>
            <td></td>
            <th>Status</th>
            <td>: {{ $pelanggar->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
        </tr>
    </table>

    <h1>Pilih Pelanggaran</h1>

    <form action="" method="get">
        <label>Cari :</label>
        <input type="text" name="cari">
        <input type="submit" value="Cari">
    </form>

    @if (Session::has('success'))
        <div class="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table>
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
                    <form action="{{ route('pelanggar.storePelanggaran', $pelanggaran->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_pelanggar" value="{{ $pelanggar->id }}">
                        <input type="hidden" name="id_user" value="{{ $idUser }}">
                        <input type="hidden" name="id_pelanggaran" value="{{ $pelanggaran->id }}">
                        <button type="submit">Tambah Pelanggaran</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">
                    Data Tidak Ditemukan - <a href="{{ route('pelanggaran.index') }}">Kembali</a>
                </td>
            </tr>
        @endforelse
    </table>

    <div style="margin-top: 20px;">
        {{ $pelanggarans->links() }}
    </div>
</body>

</html>

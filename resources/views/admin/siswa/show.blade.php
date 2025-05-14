<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 10px;
            vertical-align: top;
        }

        th {
            background-color: #f0f0f0;
            text-align: left;
        }

        .center {
            text-align: center;
        }

        img {
            border-radius: 8px;
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            font-weight: bold;
        }

        h1 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h1>Detail Siswa</h1>
    <a href="{{ route('siswa.index') }}">← Kembali ke Data Siswa</a>

    <table>
        <tr>
            <td colspan="4" class="center">
                <img src="{{ asset('storage/public/siswas/' . $siswa->image) }}" width="120px" height="120px" alt="Foto Siswa">
            </td>
        </tr>
        <tr>
            <th colspan="2">Akun Siswa</th>
            <th colspan="2">Data Siswa</th>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $siswa->name }}</td>
            <th>NIS</th>
            <td>{{ $siswa->nis }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $siswa->email }}</td>
            <th>Kelas</th>
            <td>{{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa->kelas }}</td>
        </tr>
        <tr>
            <th colspan="2"></th>
            <th>No HP</th>
            <td>{{ $siswa->hp }}</td>
        </tr>
        <tr>
            <th colspan="2"></th>
            <th>Status</th>
            <td>
                @if ($siswa->status == 1)
                    Aktif
                @else
                    Tidak Aktif
                @endif
            </td>
        </tr>
    </table>

</body>
</html>

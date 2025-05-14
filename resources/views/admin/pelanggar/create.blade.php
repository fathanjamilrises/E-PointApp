<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Siswa</title>
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

        button {
            padding: 5px 10px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        a {
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        input[type="submit"] {
            padding: 5px 10px;
        }

        form {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Pilih Data Pelanggar</h1>
    <a href="{{ route('pelanggar.index') }}">Kembali</a>

    <form action="" method="GET">
        <label for="cari">Cari :</label>
        <input type="text" name="cari" id="cari" placeholder="Cari nama/NIS...">
        <input type="submit" value="Cari">
    </form>

    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Kelas</th>
                <th>No Hp</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswas as $siswa)
                <tr>
                    <td>
                        <img src="{{ asset('storage/public/siswas/' . $siswa->image) }}" width="120" height="120"
                            alt="Foto Siswa">
                    </td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->name }}</td>
                    <td>{{ $siswa->email }}</td>
                    <td>{{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa->kelas }}</td>
                    <td>{{ $siswa->hp }}</td>
                    <td>
                        <form action="{{ route('pelanggar.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_siswa" value="{{ $siswa->id }}">
                            <button type="submit">Tambah Pelanggaran</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Data Tidak Ditemukan. Silakan cek pada halaman <a
                            href="{{ route('pelanggar.index') }}">Data Pelanggar</a>.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $siswas->links() }}
    </div>
</body>

</html>

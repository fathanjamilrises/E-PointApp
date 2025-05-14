<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        h1, h2 {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
            display: inline-block;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 8px 16px;
            margin-top: 20px;
            margin-right: 10px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
        }

        button[type="reset"] {
            background-color: #dc3545;
            color: white;
        }

        img {
            margin-top: 10px;
            border-radius: 8px;
        }

        .alert {
            background-color: #f8d7da;
            padding: 10px;
            margin-top: 15px;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h1>Edit Data Siswa</h1>
    <a href="{{ route('siswa.index') }}">← Kembali ke Data Siswa</a>

    @if ($errors->any())
        <div class="alert">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h2>Data Siswa</h2>

        <label>Foto Siswa</label>
        <img src="{{ asset('storage/public/siswas/' . $siswa->image) }}" width="120px" height="120px" alt="Foto Siswa">
        <input type="file" name="image" accept="image/*">

        <label>NIS Siswa</label>
        <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" required>

        <label>Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name', $siswa->name) }}" required>

        <label>Tingkatan</label>
        <select name="tingkatan">
            <option {{ $siswa->tingkatan == 'X' ? 'selected' : '' }} value="X">X</option>
            <option {{ $siswa->tingkatan == 'XI' ? 'selected' : '' }} value="XI">XI</option>
            <option {{ $siswa->tingkatan == 'XII' ? 'selected' : '' }} value="XII">XII</option>
        </select>

        <label>Jurusan</label>
        <select name="jurusan">
            <option {{ $siswa->jurusan == 'TBSM' ? 'selected' : '' }} value="TBSM">TBSM</option>
            <option {{ $siswa->jurusan == 'TJKT' ? 'selected' : '' }} value="TJKT">TJKT</option>
            <option {{ $siswa->jurusan == 'PPLG' ? 'selected' : '' }} value="PPLG">PPLG</option>
            <option {{ $siswa->jurusan == 'DKV' ? 'selected' : '' }} value="DKV">DKV</option>
            <option {{ $siswa->jurusan == 'TOI' ? 'selected' : '' }} value="TOI">TOI</option>
        </select>

        <label>Kelas</label>
        <select name="kelas">
            <option {{ $siswa->kelas == '1' ? 'selected' : '' }} value="1">1</option>
            <option {{ $siswa->kelas == '2' ? 'selected' : '' }} value="2">2</option>
            <option {{ $siswa->kelas == '3' ? 'selected' : '' }} value="3">3</option>
            <option {{ $siswa->kelas == '4' ? 'selected' : '' }} value="4">4</option>
        </select>

        <label>No HP</label>
        <input type="text" name="hp" value="{{ old('hp', $siswa->hp) }}" required>

        <label>Status</label>
        <select name="status">
            <option {{ $siswa->status == 1 ? 'selected' : '' }} value="1">Aktif</option>
            <option {{ $siswa->status == 0 ? 'selected' : '' }} value="0">Tidak Aktif</option>
        </select>

        <button type="submit">SIMPAN DATA</button>
        <button type="reset">RESET DATA</button>
    </form>

</body>
</html>

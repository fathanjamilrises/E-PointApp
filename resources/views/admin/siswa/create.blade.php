<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
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
        input[type="email"],
        input[type="password"],
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

    <h1>Tambah Siswa</h1>
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

    <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h2>Akun Siswa</h2>

        <label>Nama Lengkap</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label>Email Address</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" id="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <h2>Data Siswa</h2>
        
        <label>Foto Siswa</label>
        <input type="file" name="image" accept="image/*" required>

        <label>NIS Siswa</label>
        <input type="text" name="nis" value="{{ old('nis') }}" required>

        <label>Tingkatan</label>
        <select name="tingkatan" required>
            <option value="">Pilih Tingkatan</option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
        </select>

        <label>Jurusan</label>
        <select name="jurusan" required>
            <option value="">Pilih Jurusan</option>
            <option value="TBSM">TBSM</option>
            <option value="TJKT">TJKT</option>
            <option value="PPLG">PPLG</option>
            <option value="DKV">DKV</option>
            <option value="TOI">TOI</option>
        </select>

        <label>Kelas</label>
        <select name="kelas" required>
            <option value="">Pilih Kelas</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>

        <label>No HP</label>
        <input type="text" name="hp" value="{{ old('hp') }}" required>

        <button type="submit">SIMPAN DATA</button>
        <button type="reset">RESET DATA</button>
    </form>

</body>
</html>
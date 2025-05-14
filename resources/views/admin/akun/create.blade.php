<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>
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
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 8px 16px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            background-color: #007bff;
            color: white;
        }

        .alert {
            padding: 10px;
            margin-top: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Tambah Akun</h1>
    <a href="{{ route('akun.index') }}">← Kembali ke Data User</a>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin: 0;">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('akun.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2>Data Akun</h2>
    
    <label>Nama Lengkap</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    
    <label>Email Address</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    
    <label>Password</label>
    <input type="password" name="password" id="password" required>
    
    <label>Confirm Password</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>
    
    <label>Hak Akses</label>
    <select name="usertype" required>
        <option value="">Pilih Hak Akses</option>
        <option value="admin">Admin</option>
        <option value="siswa">Siswa</option>
        <option value="ptk">PTK</option>
    </select>
    
    <input type="submit" value="SIMPAN DATA">
    </form>
</body>
</html>
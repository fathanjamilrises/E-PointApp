<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data</title>
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

        button {
            padding: 8px 16px;
            margin-top: 20px;
            margin-bottom: 10px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            background-color: #007bff;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid black;
            padding: 10px;
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

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        form {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <h1>Edit Akun</h1>
    <a href="{{ route('akun.index') }}">← Kembali ke Data User</a>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin: 0;">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <form action="{{ route('akun.update', $akun->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <h2>Data Akun</h2>
        
        <label>Nama Lengkap</label>
        <input type="text" name="name" id="name" value="{{ $akun->name }}" required>

        <label>Hak Akses</label>
        <select name="usertype" required>
            <option {{ 'admin' == $akun->usertype ? 'selected' : ''}} value="admin">Admin</option>
            <option {{ 'ptk' == $akun->usertype ? 'selected' : ''}} value="ptk">PTK</option>
        </select>

        <button type="submit">SIMPAN DATA</button>
    </form>

    <form action="{{ route('updateEmail', $akun->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <h2>Update Email</h2>
        
        <label>Email Address</label>
        <input type="email" name="email" id="email" value="{{ $akun->email }}" required>

        <button type="submit">SIMPAN EMAIL</button>
    </form>

    <form action="{{ route('updatePassword', $akun->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <h2>Update Password</h2>
        
        <label>Password</label>
        <input type="password" name="password" id="password" required>

        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <button type="submit">SIMPAN PASSWORD</button>
    </form>
</body>
</html>
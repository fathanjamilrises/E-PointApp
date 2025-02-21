<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun</title>
</head>
<body>
    <h1>Tambah Akun</h1>
    <br>
    <a href="{{ route('akun.index') }}">Kembali</a>
    <br>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('akun.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Nama Lengkap</label>
    <input type="text" name="name" id="name" value="{{ old('name') }}">
    <br><br>
    <label>Email Address</label>
    <input type="email" name="email" id="email" value="{{ old('email') }}">
    <br><br>
    <label>Password</label>
    <input type="password" name="password" id="password">
    <br><br>

    <label for="password_confirmatiom" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
    <div class="col-md-6">
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>
    <br><br>

    <label>Hak Akses</label>
    <select name="usertype" required>
        <option value="">Pilih Hak Akses</option>
        <option value="admin">Admin</option>
        <option value="siswa">Siswa</option>
        <option value="ptk">PTK</option>
    </select>
   <input type="submit" value="Register">
    </form>
</body>
</html>
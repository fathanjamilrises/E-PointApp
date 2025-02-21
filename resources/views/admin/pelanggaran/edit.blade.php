<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pelanggaran</title>
    <style>
        table{
            width:100%;
            border-collapse: collapse;
            margin: 20px 0px;
        }

        table,
        th,
        td{
            border: 1px solid;
        }
    </style>
</head>
<body>
    <h1>Edit Pelanggaran</h1>
    <a href="{{ route('pelanggaran.index') }}">Kembali</a>
    <br><br>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <form action="{{ route('pelanggaran.update', $pelanggaran->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h2>Data Pelanggaran</h2>
        <label>Jenis Pelanggaran</label>
        <textarea name="jenis" id="pelanggaran" value="{{ old ('jenis') }}">{{ $pelanggaran->jenis }}</textarea>
        <br><br>
        <label>Konsekuensi Pelanggaran</label>
        <textarea name="konsekuensi" id="konsekuensi" value="{{ old ('konsekuensi') }}">{{ $pelanggaran->konsekuensi }}</textarea>
        <br><br>
         <label>Poin Pelanggaran</label>
        <input type="text" name="poin" id="poin" value="{{ $pelanggaran->poin }}">
        <br><br>

        <button type="submit">Simpan Data</button>
    </form>
</body>
</html>
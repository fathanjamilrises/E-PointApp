<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggaran</title>
</head>
<body>
    <h1>Tambah Pelanggaran</h1>
    <br>
    <a href="{{ route('pelanggaran.index') }}">Kembali</a>
    <br>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pelanggaran.store') }}" method="POST">
        @csrf

        <label>Jenis Pelanggaran</label><br>
        <textarea name="jenis" id="jenis" cols="50" rows="7">{{ old('jenis') }}</textarea>
        <br><br>

        <label>Konsekuensi</label><br>
        <textarea name="konsekuensi" id="konsekuensi" cols="50" rows="7">{{ old('konsekuensi') }}</textarea>
        <br><br>

        <label>Poin</label><br>
        <input type="number" name="poin" id="poin" value="{{ old('poin') }}" min="1">
        <br><br>

        <input type="submit" value="Tambah Pelanggaran">
    </form>
</body>
</html>

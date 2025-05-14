<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggaran</title>
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
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
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
    <h1>Tambah Pelanggaran</h1>
    <a href="{{ route('pelanggaran.index') }}">← Kembali ke Data Pelanggaran</a>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin: 0;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pelanggaran.store') }}" method="POST">
        @csrf
        <h2>Data Pelanggaran</h2>

        <label>Jenis Pelanggaran</label>
        <textarea name="jenis" id="jenis" rows="7">{{ old('jenis') }}</textarea>

        <label>Konsekuensi</label>
        <textarea name="konsekuensi" id="konsekuensi" rows="7">{{ old('konsekuensi') }}</textarea>

        <label>Poin</label>
        <input type="number" name="poin" id="poin" value="{{ old('poin') }}" min="1" required>

        <input type="submit" value="SIMPAN DATA">
    </form>
</body>
</html>
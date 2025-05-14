<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggaran</title>
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
            color: #007bff;
            margin-bottom: 20px;
            display: inline-block;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        textarea, input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 16px;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }

        .alert {
            margin-top: 10px;
            padding: 10px;
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
    </style>
</head>
<body>

    <h1>Edit Pelanggaran</h1>
    <a href="{{ route('pelanggaran.index') }}">← Kembali ke Data Pelanggaran</a>

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

    <form action="{{ route('pelanggaran.update', $pelanggaran->id)}}" method="POST">
        @csrf
        @method('PUT')

        <h2>Data Pelanggaran</h2>

        <label for="jenis">Jenis Pelanggaran</label>
        <textarea name="jenis" id="jenis" required>{{ old('jenis', $pelanggaran->jenis) }}</textarea>

        <label for="konsekuensi">Konsekuensi Pelanggaran</label>
        <textarea name="konsekuensi" id="konsekuensi" required>{{ old('konsekuensi', $pelanggaran->konsekuensi) }}</textarea>

        <label for="poin">Poin Pelanggaran</label>
        <input type="text" name="poin" id="poin" value="{{ old('poin', $pelanggaran->poin) }}" required>

        <button type="submit">Simpan Data</button>
    </form>

</body>
</html>

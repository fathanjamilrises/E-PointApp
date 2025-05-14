<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }

        .nav-link {
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        h1, h3 {
            margin-top: 30px;
        }

        .btn {
            padding: 6px 12px;
            text-decoration: none;
            background-color: #333;
            color: #fff;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <h1>Dashboard Admin</h1>

    {{-- Navigasi --}}
    <nav>
        <a href="{{ route('siswa.index') }}" class="nav-link">Data Siswa</a>
        <a href="{{ route('akun.index') }}" class="nav-link">Data Akun</a>
        <a href="{{ route('pelanggaran.index') }}" class="nav-link">Data Pelanggaran</a>
        <a href="{{ route('pelanggar.index') }}" class="nav-link">Data Pelanggar</a>
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
            @csrf
        </form>
    </nav>

    {{-- Informasi --}}
    @if($message = Session::get('success'))
        <p style="color: green; font-weight: bold;">{{ $message }}</p>
    @else
        <p>Selamat datang! Kamu telah login sebagai admin.</p>
    @endif

    <h3>Jumlah Siswa: {{ $jmlSiswas }}</h3>
    <h3>Jumlah Pelanggar: {{ $jmlPelanggars }}</h3>

    {{-- Tabel Siswa Terbanyak Poin --}}
    <h1>Top 10 Siswa dengan Poin Pelanggaran Tertinggi</h1>
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>No HP</th>
                <th>Poin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pelanggars as $pelanggar)
                <tr>
                    <td>
                        <img src="{{ asset('storage/siswas/' . $pelanggar->image) }}" width="80px" height="80px" alt="Foto Siswa">
                    </td>
                    <td>{{ $pelanggar->nis }}</td>
                    <td>{{ $pelanggar->name }}</td>
                    <td>{{ $pelanggar->tingkatan }} {{ $pelanggar->jurusan }} {{ $pelanggar->kelas }}</td>
                    <td>{{ $pelanggar->hp }}</td>
                    <td>{{ $pelanggar->poin_pelanggar }}</td>
                    <td>
                        <a href="{{ route('pelanggar.show', $pelanggar->id) }}" class="btn">Lihat Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Tabel Pelanggaran Terbanyak --}}
    <h1>Top 10 Pelanggaran yang Sering Dilakukan</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Pelanggaran</th>
                <th>Konsekuensi</th>
                <th>Poin</th>
                <th>Total Terjadi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($hitung as $hit)
                <tr>
                    <td>{{ $hit->jenis }}</td>
                    <td>{{ $hit->konsekuensi }}</td>
                    <td>{{ $hit->poin }}</td>
                    <td>{{ $hit->totals }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>

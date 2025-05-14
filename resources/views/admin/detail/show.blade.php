<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pelanggaran</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0px;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Detail Data Pelanggar</h2>
<a href="{{ route('pelanggar.index') }}">← Kembali ke Daftar Pelanggar</a>

<table>
    <tr>
        <td colspan="4" class="center">
            <img src="{{ asset('storage/public/siswas/' . $pelanggar->image) }}" width="120" height="120">
        </td>
    </tr>
    <tr>
        <th>Nama</th>
        <td>{{ $pelanggar->name }}</td>
        <th>NIS</th>
        <td>{{ $pelanggar->nis }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $pelanggar->email }}</td>
        <th>Kelas</th>
        <td>{{ $pelanggar->tingkatan }} {{ $pelanggar->jurusan }} {{ $pelanggar->kelas }}</td>
    </tr>
    <tr>
        <th>No. HP</th>
        <td>{{ $pelanggar->hp }}</td>
        <th>Status</th>
        <td>
            @if ($pelanggar->status == 0)
                Tidak Perlu Ditindak
            @elseif ($pelanggar->status == 1)
                Perlu Ditindak
            @else
                Sudah Ditindak
            @endif
        </td>
    </tr>
    <tr>
        <th>Total Poin</th>
        <td colspan="3"><strong style="font-size: 24px;">{{ $pelanggar->poin_pelanggar }}</strong></td>
    </tr>
</table>

@if (Session::has('success'))
    <div style="color: green; font-weight: bold;">
        {{ Session::get('success') }}
    </div>
@endif

<h2>Riwayat Pelanggaran</h2>

@if ($pelanggar->status == 0 || $pelanggar->status == 1)
    <script>
        alert("Poin saat ini: {{ $pelanggar->poin_pelanggar }} - Tambah pelanggaran bila perlu.");
    </script>
    <a href="{{ route('pelanggar.show', $pelanggar->id) }}">+ Tambah Pelanggaran</a>
@endif

<table>
    <thead>
        <tr>
            <th>Nama PIK</th>
            <th>Tanggal</th>
            <th>Jenis</th>
            <th>Konsekuensi</th>
            <th>Poin</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($details as $detail)
            <tr>
                <td>{{ $detail->name }}</td>
                <td>{{ $detail->created_at }}</td>
                <td>{{ $detail->jenis }}</td>
                <td>{{ $detail->konsekuensi }}</td>
                <td>{{ $detail->poin }}</td>
                <td>
                    @if ($detail->status == 0)
                        <form action="{{ route('detailPelanggar.update', $detail->id) }}" method="POST" onsubmit="return confirm('Apakah {{$pelanggar->name}} sudah diberi sanksi?')">
                            @csrf
                            @method('PUT')
                            <button type="submit">Belum Disanksi</button>
                        </form>
                    @else
                        Sudah Disanksi
                    @endif
                </td>
                <td>
                    <form action="{{ route('detailPelanggar.destroy', $detail->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pelanggaran ini?')">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id_pelanggar" value="{{ $detail->id_pelanggar }}">
                        <input type="hidden" name="poin_pelanggaran" value="{{ $detail->poin }}">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="center">Belum ada pelanggaran. <a href="{{ route('pelanggar.show', $pelanggar->id) }}">Tambah Pelanggaran</a></td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="pagination">
    {{ $details->links() }}
</div>

</body>
</html>

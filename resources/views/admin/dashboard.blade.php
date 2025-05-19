<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Heroicons CDN untuk icon (atau bisa install npm dan import) --}}
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="h-full font-sans text-gray-900">
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <x-sidebar />
        {{-- Main Content --}}
       <main class="flex-1 p-6 bg-gray-50 overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card -->
        <div class="rounded-xl bg-white p-6 shadow border">
            <div class="text-sm text-gray-500">Jumlah Siswa</div>
            <div class="mt-2 text-2xl font-semibold text-blue-600">{{ $jmlSiswas }}</div>
            <div class="text-xs text-green-600 mt-1">+5.2% dari bulan lalu</div>
        </div>

        <div class="rounded-xl bg-white p-6 shadow border">
            <div class="text-sm text-gray-500">Jumlah Pelanggar</div>
            <div class="mt-2 text-2xl font-semibold text-blue-600">{{ $jmlPelanggars }}</div>
            <div class="text-xs text-red-600 mt-1">-2.3% dari bulan lalu</div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Statistik Pelanggaran</h3>
            <canvas id="chartPelanggaran"></canvas>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Statistik Siswa</h3>
            <canvas id="chartSiswa"></canvas>
        </div>
    </div>

    <!-- Tabel Top 10 -->
    <div class="bg-white p-6 rounded-xl shadow border">
        <h3 class="text-xl font-semibold mb-4 text-gray-800">Top 10 Siswa dengan Poin Tertinggi</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-gray-600 font-semibold">
                    <tr>
                        <th class="p-3 text-left">Foto</th>
                        <th class="p-3 text-left">Nama</th>
                        <th class="p-3 text-left">Kelas</th>
                        <th class="p-3 text-left">Poin</th>
                        <th class="p-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($pelanggars as $p)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3">
                                <img src="{{ asset('storage/siswas/' . $p->image) }}" class="w-10 h-10 rounded-full object-cover">
                            </td>
                            <td class="p-3">{{ $p->name }}</td>
                            <td class="p-3">{{ $p->tingkatan }} {{ $p->jurusan }} {{ $p->kelas }}</td>
                            <td class="p-3 font-semibold text-blue-600">{{ $p->poin_pelanggar }}</td>
                            <td class="p-3">
                                <a href="{{ route('pelanggar.show', $p->id) }}" class="text-blue-600 hover:underline text-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx1 = document.getElementById('chartPelanggaran');
    const chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: {!! json_encode($hitung->pluck('jenis')) !!},
            datasets: [{
                label: 'Jumlah',
                data: {!! json_encode($hitung->pluck('totals')) !!},
                backgroundColor: '#3b82f6'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

</body>
</html>

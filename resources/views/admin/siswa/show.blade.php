<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Siswa</title>
    @vite('resources/css/app.css') {{-- Pastikan Tailwind sudah di-compile --}}
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex">

    {{-- Sidebar --}}
    <x-sidebar />

    {{-- Main Content --}}
    <main class="flex-1 p-6 max-w-5xl mx-auto mt-20">

        <h1 class="text-3xl font-bold mb-8 text-gray-900">Detail Siswa</h1>

        <div class="flex flex-col md:flex-row md:items-center md:gap-10 mb-8">
            <img 
                src="{{ asset('storage/public/siswas/' . $siswa->image) }}" 
                alt="Foto Siswa" 
                class="rounded-lg w-40 h-40 object-cover shadow-lg mx-auto md:mx-0"
            />
            <div class="mt-6 md:mt-0">
                <h2 class="text-xl font-semibold text-gray-700 mb-3 border-b border-gray-200 pb-2">Akun Siswa</h2>
                <p class="mb-2"><span class="font-semibold text-gray-900">Nama:</span> {{ $siswa->name }}</p>
                <p><span class="font-semibold text-gray-900">Email:</span> {{ $siswa->email }}</p>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold text-gray-700 mb-3 border-b border-gray-200 pb-2">Data Siswa</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-gray-800">
                <div>
                    <p><span class="font-semibold">NIS:</span> {{ $siswa->nis }}</p>
                </div>
                <div>
                    <p><span class="font-semibold">Kelas:</span> {{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa->kelas }}</p>
                </div>
                <div>
                    <p><span class="font-semibold">No HP:</span> {{ $siswa->hp }}</p>
                </div>
                <div>
                    <p>
                        <span class="font-semibold">Status:</span> 
                        @if ($siswa->status == 1)
                            <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-sm">Aktif</span>
                        @else
                            <span class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold text-sm">Tidak Aktif</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

    </main>

</body>
</html>

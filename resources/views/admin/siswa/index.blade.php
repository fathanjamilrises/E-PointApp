<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') {{-- Pastikan Tailwind sudah dikompilasi --}}
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main content --}}
        <main class="flex-1 p-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Data Siswa</h1>
            </div>

            <div class="flex items-center justify-between mb-6">
                {{-- Search --}}
                <form action="" method="GET" class="mb-4 flex items-center space-x-2">
                    <label for="cari" class="text-sm">Cari :</label>
                    <input type="text" name="cari" id="cari" placeholder="Cari nama/NIS..."
                        class="px-3 py-2 border rounded-md w-64">
                    <button type="submit"
                        class="px-4 py-2 text-white bg-gray-800 rounded hover:bg-gray-700">Cari</button>
                </form>
                <a href="{{ route('siswa.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">+
                    Tambah Siswa</a>
            </div>



            {{-- Alert --}}
            @if (Session::has('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded border border-green-300">
                    {{ Session::get('success') }}
                </div>
            @endif

            {{-- Table --}}
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">Foto</th>
                            <th scope="col" class="px-6 py-3 text-center">NIS</th>
                            <th scope="col" class="px-6 py-3 text-center">Nama</th>
                            <th scope="col" class="px-6 py-3 text-center">Email</th>
                            <th scope="col" class="px-6 py-3 text-center">Kelas</th>
                            <th scope="col" class="px-6 py-3 text-center">Status</th>
                            <th scope="col" class="px-6 py-3 text-center">No HP</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswas as $siswa)
                            <tr class="border-b hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 text-center">
                                    <img src="{{ asset('storage/public/siswas/' . $siswa->image) }}"
                                        class="w-12 h-12 mx-auto rounded-full object-cover border">
                                </td>
                                <td class="px-6 py-4 text-center">{{ $siswa->nis }}</td>
                                <td class="px-6 py-4 text-center">{{ $siswa->name }}</td>
                                <td class="px-6 py-4 text-center">{{ $siswa->email }}</td>
                                <td class="px-6 py-4 text-center">{{ $siswa->tingkatan }} {{ $siswa->jurusan }}
                                    {{ $siswa->kelas }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if ($siswa->status == 1)
                                        <span
                                            class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Aktif</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Tidak
                                            Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">{{ $siswa->hp }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2 flex-wrap items-center">

                                        {{-- SHOW --}}
                                        <a href="{{ route('siswa.show', $siswa->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-800 transition"
                                            title="Lihat">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>

                                        {{-- EDIT --}}
                                        <a href="{{ route('siswa.edit', $siswa->id) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 text-blue-600 hover:text-blue-800 transition"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487a2.1 2.1 0 113.02 2.92l-.753.753-3.02-3.02.753-.753zM15.225 6.125L4.5 16.85V19.5h2.65L17.775 8.775l-2.55-2.55z" />
                                            </svg>
                                        </a>

                                        {{-- DELETE --}}
                                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 hover:bg-red-200 text-red-600 hover:text-red-800 transition"
                                                title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Data tidak ditemukan. <a href="{{ route('siswa.index') }}"
                                        class="text-blue-600 hover:underline">Kembali</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            {{-- Pagination --}}
            <div class="mt-6">
                {{ $siswas->links() }}
            </div>

        </main>
    </div>

</body>

</html>

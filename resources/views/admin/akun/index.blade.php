<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Data User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
                <h1 class="text-2xl font-bold text-gray-800">Data User</h1>
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
                <a href="{{ route('akun.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">+
                    Tambah User</a>
            </div>


            {{-- Notifikasi --}}
            @if (Session::has('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
                    {{ Session::get('success') }}
                </div>
            @endif

            {{-- Tabel User --}}
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full text-left text-gray-700 text-sm">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Role</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">{{ $user->usertype }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if ($user->usertype == 'admin')
                                        <a href="{{ route('akun.edit', $user->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 text-blue-600 hover:text-blue-800 transition"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487a2.1 2.1 0 113.02 2.92l-.753.753-3.02-3.02.753-.753zM15.225 6.125L4.5 16.85V19.5h2.65L17.775 8.775l-2.55-2.55z" />
                                                </svg>
                                            </a>
                                    @else
                                        <form action="{{ route('akun.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('{{ $user->usertype == 'siswa' ? 'Jika akun siswa dihapus maka data siswa juga akan dihapus, apakah anda yakin?' : 'Anda yakin?' }}')"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('akun.edit', $user->id) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 hover:bg-blue-200 text-blue-600 hover:text-blue-800 transition"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487a2.1 2.1 0 113.02 2.92l-.753.753-3.02-3.02.753-.753zM15.225 6.125L4.5 16.85V19.5h2.65L17.775 8.775l-2.55-2.55z" />
                                                </svg>
                                            </a>
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
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">
                                    Data tidak ditemukan. <a href="{{ route('akun.index') }}"
                                        class="text-blue-600 hover:underline">Kembali</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </main>

    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Edit Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css') {{-- Pastikan Tailwind dikompilasi --}}
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            {{-- Header --}}
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">Edit Data Siswa</h1>
            </div>

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-md">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 bg-white p-4 rounded-lg shadow">
                @csrf
                @method('PUT')

                <h2 class="text-lg font-bold text-gray-700 mb-4">Data Siswa</h2>

                {{-- Foto --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Siswa</label>
                    <img src="{{ asset('storage/public/siswas/' . $siswa->image) }}" 
                         alt="Foto Siswa" 
                         class="w-32 h-32 object-cover rounded-lg mb-2 border" />
                    <input type="file" name="image" accept="image/*"
                        class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:border file:rounded-md file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700">NIS Siswa</label>
                        <input type="text" name="nis" id="nis" value="{{ old('nis', $siswa->nis) }}" required
                            class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200" />
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $siswa->name) }}" required
                            class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200" />
                    </div>

                    <div>
                        <label for="tingkatan" class="block text-sm font-medium text-gray-700">Tingkatan</label>
                        <select name="tingkatan" id="tingkatan" required
                            class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                            <option value="">Pilih Tingkatan</option>
                            <option value="X" {{ $siswa->tingkatan == 'X' ? 'selected' : '' }}>X</option>
                            <option value="XI" {{ $siswa->tingkatan == 'XI' ? 'selected' : '' }}>XI</option>
                            <option value="XII" {{ $siswa->tingkatan == 'XII' ? 'selected' : '' }}>XII</option>
                        </select>
                    </div>

                    <div>
                        <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                        <select name="jurusan" id="jurusan" required
                            class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                            <option value="">Pilih Jurusan</option>
                            <option value="TBSM" {{ $siswa->jurusan == 'TBSM' ? 'selected' : '' }}>TBSM</option>
                            <option value="TJKT" {{ $siswa->jurusan == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                            <option value="PPLG" {{ $siswa->jurusan == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                            <option value="DKV" {{ $siswa->jurusan == 'DKV' ? 'selected' : '' }}>DKV</option>
                            <option value="TOI" {{ $siswa->jurusan == 'TOI' ? 'selected' : '' }}>TOI</option>
                        </select>
                    </div>

                    <div>
                        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                        <select name="kelas" id="kelas" required
                            class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                            <option value="">Pilih Kelas</option>
                            <option value="1" {{ $siswa->kelas == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ $siswa->kelas == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ $siswa->kelas == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ $siswa->kelas == '4' ? 'selected' : '' }}>4</option>
                        </select>
                    </div>

                    <div>
                        <label for="hp" class="block text-sm font-medium text-gray-700">No HP</label>
                        <input type="text" name="hp" id="hp" value="{{ old('hp', $siswa->hp) }}" required
                            class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200" />
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" required
                            class="mt-1 block w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-200">
                            <option value="1" {{ $siswa->status == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $siswa->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="reset"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Reset</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Simpan</button>
                </div>
            </form>
        </main>
    </div>

</body>

</html>

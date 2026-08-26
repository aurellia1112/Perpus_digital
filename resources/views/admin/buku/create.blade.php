<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.buku.store') }}" method="POST">
                    @csrf

                    <!-- Kode Buku -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Kode Buku</label>
                        <input
                            type="text"
                            name="kode_buku"
                            value="{{ old('kode_buku') }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            placeholder="Contoh: BK-001"
                            required
                        >
                        @error('kode_buku')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul Buku -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Judul Buku</label>
                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul') }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            placeholder="Masukkan judul buku"
                            required
                        >
                        @error('judul')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pengarang -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Pengarang</label>
                        <input
                            type="text"
                            name="pengarang"
                            value="{{ old('pengarang') }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            placeholder="Nama pengarang / penulis"
                            required
                        >
                        @error('pengarang')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Penerbit -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Penerbit</label>
                        <input
                            type="text"
                            name="penerbit"
                            value="{{ old('penerbit') }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            placeholder="Nama penerbit"
                            required
                        >
                        @error('penerbit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">Stok</label>
                        <input
                            type="number"
                            name="stok"
                            value="{{ old('stok', 1) }}"
                            min="0"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            required
                        >
                        @error('stok')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center gap-3">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md shadow-sm">
                            Simpan Buku
                        </button>
                        <a href="{{ route('admin.buku.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded-md shadow-sm">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
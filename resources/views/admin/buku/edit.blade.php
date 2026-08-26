<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Kode Buku -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Kode Buku</label>
                        <input
                            type="text"
                            name="kode_buku"
                            value="{{ old('kode_buku', $buku->kode_buku) }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
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
                            value="{{ old('judul', $buku->judul) }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
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
                            value="{{ old('pengarang', $buku->pengarang) }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
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
                            value="{{ old('penerbit', $buku->penerbit) }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
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
                            value="{{ old('stok', $buku->stok) }}"
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
                            Perbarui Buku
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
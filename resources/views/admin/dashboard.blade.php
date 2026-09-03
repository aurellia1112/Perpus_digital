<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h3>
                <p class="text-gray-600 text-sm">
                    Anda masuk sebagai <strong>Administrator Perpustakaan Digital</strong>. Silakan gunakan menu navigasi di atas atau tombol di bawah untuk mengelola data perpustakaan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-emerald-500">
                    <h4 class="font-bold text-gray-700 text-lg mb-2">📚 Kelola Buku</h4>
                    <p class="text-sm text-gray-600 mb-4">Kelola katalog buku, tambah judul baru, dan perbarui stok buku.</p>
                    <a href="{{ route('admin.buku.index') }}" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-medium px-4 py-2 rounded text-sm shadow">Lihat Buku &rarr;</a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <h4 class="font-bold text-gray-700 text-lg mb-2">👥 Kelola Anggota</h4>
                    <p class="text-sm text-gray-600 mb-4">Kelola data anggota perpustakaan dan data akun admin.</p>
                    <a href="{{ route('admin.user.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded text-sm shadow">Lihat Anggota &rarr;</a>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <h4 class="font-bold text-gray-700 text-lg mb-2">📖 Kelola Transaksi</h4>
                    <p class="text-sm text-gray-600 mb-4">Catat peminjaman buku baru dan proses pengembalian buku.</p>
                    <a href="{{ route('admin.peminjaman.index') }}" class="inline-block bg-purple-600 hover:bg-purple-700 text-white font-medium px-4 py-2 rounded text-sm shadow">Lihat Peminjaman &rarr;</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

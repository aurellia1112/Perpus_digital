<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Anggota Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">
                            Alamat Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            placeholder="contoh@email.com"
                            required
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">
                            Password
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            placeholder="••••••••"
                            required
                        >
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700">
                            Role / Hak Akses
                        </label>
                        <select
                            name="role"
                            class="border-gray-300 rounded-md shadow-sm w-full"
                            required
                        >
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>
                                User / Siswa
                            </option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex items-center gap-3">
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-md shadow-sm"
                        >
                            Simpan Anggota
                        </button>
                        <a
                            href="{{ route('admin.user.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded-md shadow-sm"
                        >
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
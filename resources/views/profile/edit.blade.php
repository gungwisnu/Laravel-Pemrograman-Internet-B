<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-8 mt-10 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit Profil</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-center font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('PATCH')

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" name="password" id="password"
                       placeholder="Kosongkan jika tidak ingin mengganti password"
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-between mt-6">
                <button type="submit"
                        class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-6 py-2 rounded-lg hover:from-blue-500 hover:to-blue-700 transition-all duration-300">
                    Simpan Perubahan
                </button>

                <a href="{{ route('dashboard') }}"
                   class="bg-gradient-to-r from-red-400 to-red-600 text-white px-6 py-2 rounded-lg hover:from-red-500 hover:to-red-700 transition-all duration-300">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>

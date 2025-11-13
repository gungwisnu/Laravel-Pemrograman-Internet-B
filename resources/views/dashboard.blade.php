<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-2">Halo, {{ $user->name }}!</h1>
                <p class="mb-4">Selamat datang di Dashboard Kamu 🎉</p>

                <a href="{{ route('profile.edit') }}" class="text-blue-600 underline">Lihat Profil Saya</a>
            </div>
        </div>
    </div>
</x-app-layout>

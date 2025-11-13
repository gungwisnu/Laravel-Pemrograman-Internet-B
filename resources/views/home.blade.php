<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Laravel Pemrograman Internet B</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-3xl p-6 bg-white rounded-lg shadow-lg border border-gray-200">
            <h1 class="text-xl font-semibold text-center text-gray-800 mb-5">
                Tugas Laravel Pemrograman Internet B
            </h1>

            <div class="space-y-4">
                <div>
                    <a href="{{ url('/mahasiswa') }}"
                        class="block text-center text-white font-semibold py-3 px-5 rounded-lg text-base
                        bg-gradient-to-r from-blue-400 to-blue-600 
                        hover:from-blue-500 hover:to-blue-700 transition-all duration-300 shadow-md">
                        Mahasiswa
                    </a>
                </div>
                <div>
                    <a href="{{ url('/prodi') }}"
                        class="block text-center text-white font-semibold py-3 px-5 rounded-lg text-base
                        bg-gradient-to-r from-blue-400 to-blue-600 
                        hover:from-blue-500 hover:to-blue-700 transition-all duration-300 shadow-md">
                        Program Studi
                    </a>
                </div>
                <div>
                    <a href="{{ url('/fakultas') }}"
                        class="block text-center text-white font-semibold py-3 px-5 rounded-lg text-base
                        bg-gradient-to-r from-blue-400 to-blue-600 
                        hover:from-blue-500 hover:to-blue-700 transition-all duration-300 shadow-md">
                        Fakultas
                    </a>
                </div>
            </div>

            <p class="mt-5 text-center text-xs text-gray-500">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"
                   class="hover:font-semibold hover:text-gray-700 transition-all duration-200">
                    Anak Agung Gede Wisnu Mahadhiva - 2405551106
                </a>
            </p>
        </div>
    </div>
</body>

</html>

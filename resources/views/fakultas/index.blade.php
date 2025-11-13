<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Fakultas</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<x-app-layout>
<body class="bg-gray-100 font-sans">

  <!-- Tombol atas -->
  <div class="container mx-auto py-4 flex items-center justify-between">
    @if(Auth::user()->role === 'admin')
      <a href="{{ route('fakultas.create') }}"
         class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all duration-300">
        Tambah Fakultas
      </a>
    @else
      <div></div> {{-- biar tombol kanan tetap di kanan --}}
    @endif

    <div class="flex items-center gap-3 relative">
      <button id="btnCari"
              class="bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all duration-300">
        Cari Fakultas
      </button>

      <div id="searchBox"
           class="absolute right-full mr-3 transform translate-x-4 opacity-0 w-0 overflow-hidden transition-all duration-500 ease-in-out">
        <input type="text" id="keyword" placeholder="Ketik nama/kode fakultas..."
               class="p-2 w-80 border border-gray-300 rounded-lg focus:outline-none focus:ring-0">
      </div>
    </div>
  </div>

  <!-- Notifikasi sukses -->
  @if (session('success'))
    <div id="successMessage"
         class="fixed top-6 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-300 text-green-700 px-6 py-3 rounded-lg shadow-md opacity-0 -translate-y-4 transition-all duration-500 ease-in-out">
      {!! session('success') !!}
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const msg = document.getElementById("successMessage");
        if (msg) {
          setTimeout(() => msg.classList.replace("opacity-0", "opacity-100"), 100);
          setTimeout(() => msg.classList.replace("opacity-100", "opacity-0"), 5000);
          setTimeout(() => msg.remove(), 5500);
        }
      });
    </script>
  @endif

  <!-- Tabel Fakultas -->
  <div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-center mb-6">Daftar Fakultas</h2>

    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
      <thead class="bg-gradient-to-r from-blue-400 to-blue-600 text-white">
        <tr>
          <th class="py-3 px-6 text-left">ID</th>
          <th class="py-3 px-6 text-left">Kode Fakultas</th>
          <th class="py-3 px-6 text-left">Nama Fakultas</th>
          @if(Auth::user()->role === 'admin')
            <th class="py-3 px-6 text-left">Aksi</th>
          @endif
        </tr>
      </thead>

      <tbody id="hasil">
        @foreach ($fakultas as $f)
          <tr class="border-b hover:bg-gray-100 transition-colors duration-300">
            <td class="py-3 px-6">{{ $f->id }}</td>
            <td class="py-3 px-6">{{ $f->kode_fakultas }}</td>
            <td class="py-3 px-6">{{ $f->nama_fakultas }}</td>

            @if(Auth::user()->role === 'admin')
              <td class="py-3 px-6 flex gap-2">
                <a href="{{ route('fakultas.edit', $f->id) }}" class="text-blue-500 hover:text-blue-700 transition">Edit</a> | 
                <a href="{{ route('fakultas.confirmDelete', $f->id) }}" class="text-red-500 hover:text-red-700 transition">Hapus</a>
              </td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>

    <p class="mt-8 text-center text-sm text-gray-500 cursor-pointer hover:text-black font-medium transition"
       onclick="window.open('https://www.youtube.com/watch?v=dQw4w9WgXcQ', '_blank')">
       Anak Agung Gede Wisnu Mahadhiva - 2405551106
    </p>
  </div>

  <!-- JS Pencarian -->
  <script>
    const btnCari = document.getElementById("btnCari");
    const searchBox = document.getElementById("searchBox");
    btnCari.addEventListener("click", () => {
      searchBox.classList.toggle("w-0");
      searchBox.classList.toggle("opacity-0");
      searchBox.classList.toggle("translate-x-4");
      searchBox.classList.toggle("w-80");
      searchBox.classList.toggle("opacity-100");
      searchBox.classList.toggle("translate-x-0");
    });

    const keywordInput = document.getElementById("keyword");
    const hasil = document.getElementById("hasil");

    keywordInput.addEventListener("keyup", function() {
      const keyword = this.value;
      fetch(`/fakultas?search=${keyword}`)
        .then(response => response.text())
        .then(html => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, "text/html");
          hasil.innerHTML = doc.querySelector("#hasil").innerHTML;
        });
    });
  </script>

</body>
</x-app-layout>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mahasiswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <div class="container mx-auto py-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Tambah Mahasiswa</h1>

    <form action="{{ route('mahasiswa.store') }}" method="POST" 
          class="bg-white p-8 rounded-lg shadow-lg space-y-4 max-w-2xl mx-auto">
      @csrf

      <!-- NIM -->
      <div>
        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
        <input type="text" name="nim" id="nim" value="{{ old('nim') }}" 
               class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <!-- Nama -->
      <div>
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" 
               class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <!-- Fakultas -->
      <div>
        <label for="fakultas" class="block text-sm font-medium text-gray-700">Fakultas</label>
        <select id="fakultas" name="fakultas_id" required
                class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
          <option value="">-- Pilih Fakultas --</option>
          @foreach ($fakultas as $f)
            <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
          @endforeach
        </select>
      </div>

      <!-- Program Studi -->
      <div>
        <label for="prodi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
        <select name="prodi_id" id="prodi_id" disabled required
                class="w-full px-4 py-2 mt-1 border rounded-md bg-gray-100 text-gray-500 cursor-not-allowed focus:outline-none">
          <option value="">-- Pilih Fakultas terlebih dahulu --</option>
        </select>
      </div>

      <!-- Tombol Simpan -->
      <button type="submit" 
              class="w-full py-3 bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-md font-semibold hover:from-blue-500 hover:to-blue-700 transition">
        Simpan
      </button>

      <!-- Tombol Kembali -->
      <div class="pt-3">
        <a href="{{ route('mahasiswa.index') }}" 
           class="inline-block w-full text-center bg-gradient-to-r from-red-400 to-red-600 text-white px-4 py-2 rounded-md font-semibold hover:from-red-500 hover:to-red-700 transition">
          Kembali
        </a>
      </div>
    </form>

    <!-- Error Validation -->
    @if ($errors->any())
      <div class="mt-6 text-red-600 text-center">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>

  <p class="mt-8 text-center text-sm text-gray-500 cursor-pointer hover:text-black font-medium transition"
      onclick="window.open('https://www.youtube.com/watch?v=dQw4w9WgXcQ', '_blank')">
      Anak Agung Gede Wisnu Mahadhiva - 2405551106
  </p>

  <script>
    const fakultasSelect = document.getElementById('fakultas');
    const prodiSelect = document.getElementById('prodi_id');

    fakultasSelect.addEventListener('change', function() {
      const fakultasId = this.value;

      if (fakultasId) {
        // Aktifkan dropdown prodi
        prodiSelect.disabled = false;
        prodiSelect.classList.remove('bg-gray-100', 'cursor-not-allowed', 'text-gray-500');
        prodiSelect.classList.add('bg-white', 'cursor-pointer', 'text-black');

        // Fetch prodi berdasarkan fakultas
        fetch(`/get-prodi/${fakultasId}`)
          .then(res => res.json())
          .then(data => {
            prodiSelect.innerHTML = '<option value="">-- Pilih Program Studi --</option>';
            data.forEach(p => {
              const opt = document.createElement('option');
              opt.value = p.id;
              opt.textContent = p.nama_prodi;
              prodiSelect.appendChild(opt);
            });
          });
      } else {
        // Reset ke kondisi awal kalau fakultas belum dipilih
        prodiSelect.disabled = true;
        prodiSelect.innerHTML = '<option value="">-- Pilih Fakultas terlebih dahulu --</option>';
        prodiSelect.classList.add('bg-gray-100', 'cursor-not-allowed', 'text-gray-500');
        prodiSelect.classList.remove('bg-white', 'cursor-pointer', 'text-black');
      }
    });
  </script>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Program Studi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

  <div class="container mx-auto py-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Tambah Program Studi</h1>

    <form action="{{ route('prodi.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg space-y-4 max-w-2xl mx-auto">
      @csrf

      <div>
        <label for="kode_prodi" class="block text-sm font-medium text-gray-700">Kode Prodi</label>
        <input type="text" name="kode_prodi" id="kode_prodi" value="{{ old('kode_prodi') }}" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <div>
        <label for="nama_prodi" class="block text-sm font-medium text-gray-700">Nama Prodi</label>
        <input type="text" name="nama_prodi" id="nama_prodi" value="{{ old('nama_prodi') }}" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
      </div>

      <div>
        <label for="fakultas_id" class="block text-sm font-medium text-gray-700">Fakultas</label>
        <select name="fakultas_id" id="fakultas_id" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
          <option value="">-- Pilih Fakultas --</option>
          @foreach ($fakultas as $f)
            <option value="{{ $f->id }}" {{ old('fakultas_id') == $f->id ? 'selected' : '' }}>{{ $f->nama_fakultas }} ({{ $f->kode_fakultas }})</option>
          @endforeach
        </select>
      </div>

      <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-md font-semibold hover:from-blue-500 hover:to-blue-700 transition">
        Simpan
      </button>

      <div class="pt-3">
        <a href="{{ route('prodi.index') }}" class="inline-block w-full text-center bg-gradient-to-r from-red-400 to-red-600 text-white px-4 py-2 rounded-md font-semibold hover:from-red-500 hover:to-red-700 transition">
          Kembali
        </a>
      </div>
    </form>

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

  <p class="mt-8 text-center text-sm text-gray-500 cursor-pointer"
     onclick="window.open('https://www.youtube.com/watch?v=dQw4w9WgXcQ', '_blank')">
     Anak Agung Gede Wisnu Mahadhiva - 2405551106
  </p>
</body>
</html>

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaApiController extends Controller
{
    // Tampilkan semua data mahasiswa
    public function index()
    {
        return response()->json(Mahasiswa::with('prodi.fakultas')->get());
    }

    // Simpan data mahasiswa baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required|string|max:255',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $mahasiswa = Mahasiswa::create($validated);

        return response()->json([
            'message' => 'Mahasiswa berhasil ditambahkan',
            'data' => $mahasiswa
        ], 201);
    }

    // Tampilkan satu data mahasiswa
    public function show($id)
    {
        $mahasiswa = Mahasiswa::with('prodi.fakultas')->find($id);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($mahasiswa);
    }

    // Update data mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,' . $id,
            'nama' => 'required|string|max:255',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $mahasiswa->update($validated);

        return response()->json([
            'message' => 'Mahasiswa berhasil diperbarui',
            'data' => $mahasiswa
        ]);
    }

    // Hapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $mahasiswa->delete();

        return response()->json(['message' => 'Mahasiswa berhasil dihapus']);
    }
}

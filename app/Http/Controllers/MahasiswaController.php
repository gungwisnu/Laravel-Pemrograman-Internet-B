<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /** ===========================
     *  TAMPILKAN SEMUA MAHASISWA
     *  =========================== */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'asc');

        // Batasi kolom yang bisa di-sort
        if (!in_array($sort, ['id', 'nim', 'nama', 'prodi_id', 'created_at'])) {
            $sort = 'id';
        }

        $mahasiswas = Mahasiswa::with('prodi.fakultas')
            ->orderBy($sort, $order)
            ->get();

        return view('mahasiswa.index', compact('mahasiswas', 'sort', 'order'));
    }

    /** ===========================
     *  FORM TAMBAH DATA MAHASISWA
     *  =========================== */
    public function create()
    {
        $fakultas = Fakultas::all();
        $prodis = Prodi::with('fakultas')->get();

        return view('mahasiswa.create', compact('fakultas', 'prodis'));
    }

    /** ===========================
     *  SIMPAN DATA MAHASISWA BARU
     *  =========================== */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim|min:4',
            'nama' => 'required',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', "Data Mahasiswa <b>{$mahasiswa->nim}</b> berhasil ditambahkan!");
    }

    /** ===========================
     *  FORM EDIT DATA MAHASISWA
     *  =========================== */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $fakultas = Fakultas::all();
        $prodis = Prodi::with('fakultas')->get();

        return view('mahasiswa.edit', compact('mahasiswa', 'fakultas', 'prodis'));
    }

    /** ===========================
     *  UPDATE DATA MAHASISWA
     *  =========================== */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|numeric|min:4|unique:mahasiswas,nim,' . $id,
            'nama' => 'required',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'prodi_id' => $request->prodi_id,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', "Data Mahasiswa <b>{$mahasiswa->nim}</b> berhasil diperbarui!");
    }

    /** ===========================
     *  HALAMAN KONFIRMASI HAPUS
     *  =========================== */
    public function confirmDelete($id)
    {
        $mahasiswa = Mahasiswa::with('prodi.fakultas')->findOrFail($id);
        return view('mahasiswa.delete', compact('mahasiswa'));
    }

    /** ===========================
     *  HAPUS DATA MAHASISWA
     *  =========================== */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $nim = $mahasiswa->nim;
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', "Data Mahasiswa <b>{$nim}</b> berhasil dihapus!");
    }

    /** ===========================
     *  PENCARIAN (AJAX)
     *  =========================== */
    public function search(Request $request)
    {
        $keyword = $request->get('keyword', '');

        $hasil = Mahasiswa::with('prodi.fakultas')
            ->where('nama', 'like', "%{$keyword}%")
            ->orWhere('nim', 'like', "%{$keyword}%")
            ->orWhereHas('prodi', function ($q) use ($keyword) {
                $q->where('nama_prodi', 'like', "%{$keyword}%");
            })
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($hasil);
    }

    /** ===========================
     *  AJAX - FILTER PRODI BY FAKULTAS
     *  =========================== */
    public function getProdiByFakultas($fakultas_id)
    {
        $prodi = Prodi::where('fakultas_id', $fakultas_id)->get();
        return response()->json($prodi);
    }
}

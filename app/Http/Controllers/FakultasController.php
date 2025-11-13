<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index(Request $request)
    {
        // ambil parameter sort & order (default: id asc)
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'asc');
        $search = $request->get('search');

        // query dasar
        $query = Fakultas::query();

        // jika ada pencarian
        if ($search) {
            $query->where('nama_fakultas', 'like', "%{$search}%")
                  ->orWhere('kode_fakultas', 'like', "%{$search}%");
        }

        // urutkan data
        $fakultas = $query->orderBy($sort, $order)->get();

        // kirim variabel ke view
        return view('fakultas.index', compact('fakultas', 'sort', 'order'));
    }

    public function create()
    {
        return view('fakultas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_fakultas' => 'required|unique:fakultas,kode_fakultas|min:2',
            'nama_fakultas' => 'required|min:3',
        ], [
            'kode_fakultas.required' => 'Kode Fakultas wajib diisi',
            'kode_fakultas.unique' => 'Kode Fakultas sudah terdaftar',
            'nama_fakultas.required' => 'Nama Fakultas wajib diisi'
        ]);

        $f = Fakultas::create($request->only('kode_fakultas','nama_fakultas'));

        return redirect()->route('fakultas.index')
            ->with('success', "Data dengan kode <strong>{$f->kode_fakultas}</strong> berhasil ditambahkan!");
    }

    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('fakultas.edit', compact('fakultas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_fakultas' => 'required|min:2|unique:fakultas,kode_fakultas,'.$id,
            'nama_fakultas' => 'required|min:3',
        ]);

        $f = Fakultas::findOrFail($id);
        $f->update($request->only('kode_fakultas','nama_fakultas'));

        return redirect()->route('fakultas.index')
            ->with('success', "Data dengan kode <strong>{$f->kode_fakultas}</strong> berhasil diperbarui!");
    }

    public function confirmDelete($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('fakultas.delete', compact('fakultas'));
    }

    public function destroy($id)
    {
        $f = Fakultas::findOrFail($id);
        $kode = $f->kode_fakultas;
        $f->delete();

        return redirect()->route('fakultas.index')
            ->with('success', "Data dengan kode <strong>{$kode}</strong> berhasil dihapus!");
    }
}

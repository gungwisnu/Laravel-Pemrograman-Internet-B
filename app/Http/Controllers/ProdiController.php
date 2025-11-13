<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'asc');
        $search = $request->get('search', '');

        // batasi kolom sort biar aman
        if (!in_array($sort, ['id', 'kode_prodi', 'nama_prodi', 'fakultas_id'])) {
            $sort = 'id';
        }

        $prodi = Prodi::with('fakultas')
            ->when($search, function ($query, $search) {
                $query->where('nama_prodi', 'like', "%{$search}%")
                      ->orWhere('kode_prodi', 'like', "%{$search}%")
                      ->orWhereHas('fakultas', function ($q) use ($search) {
                          $q->where('nama_fakultas', 'like', "%{$search}%");
                      });
            })
            ->orderBy($sort, $order)
            ->get();

        return view('prodi.index', compact('prodi', 'sort', 'order', 'search'));
    }

    public function create()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('prodi.create', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|unique:prodi,kode_prodi|min:2',
            'nama_prodi' => 'required|min:3',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        $p = Prodi::create($request->only('kode_prodi', 'nama_prodi', 'fakultas_id'));

        return redirect()->route('prodi.index')->with('success', "Data dengan kode <strong>{$p->kode_prodi}</strong> berhasil ditambahkan!");
    }

    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $fakultas = Fakultas::orderBy('nama_fakultas')->get();
        return view('prodi.edit', compact('prodi', 'fakultas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_prodi' => 'required|min:2|unique:prodi,kode_prodi,' . $id,
            'nama_prodi' => 'required|min:3',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        $p = Prodi::findOrFail($id);
        $p->update($request->only('kode_prodi', 'nama_prodi', 'fakultas_id'));

        return redirect()->route('prodi.index')->with('success', "Data dengan kode <strong>{$p->kode_prodi}</strong> berhasil diperbarui!");
    }

    public function confirmDelete($id)
    {
        $prodi = Prodi::with('fakultas')->findOrFail($id);
        return view('prodi.delete', compact('prodi'));
    }

    public function destroy($id)
    {
        $p = Prodi::findOrFail($id);
        $kode = $p->kode_prodi;
        $p->delete();

        return redirect()->route('prodi.index')->with('success', "Data dengan kode <strong>{$kode}</strong> berhasil dihapus!");
    }
}

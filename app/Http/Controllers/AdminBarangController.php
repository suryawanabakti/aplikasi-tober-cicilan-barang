<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class AdminBarangController extends Controller
{
    public function index()
    {
        $barangBarang = Barang::orderBy('created_at', 'desc')->get();
        return view('admin.barang.index', compact('barangBarang'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => ['required'],
            'nama' => ['required'],
            'satuan' => ['required'],
            'harga' => ['required', 'numeric'],
            'stok' => ['required'],
            'gambar' => ['image', 'mimes:png,jpeg,jpg']
        ]);
        if ($request->gambar) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('storage/gambar'), $imageName);
            $validatedData['gambar'] = 'gambar/' . $imageName;
        }
        Barang::create($validatedData);
        return back();
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return back();
    }
}

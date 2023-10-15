<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class CustomerPesananController extends Controller
{
    public function index()
    {
        $pesananPesanan = Pesanan::orderBy('created_at', 'desc')->where('user_id', auth()->id())->get();

        return view('customer.pesanan.index', compact('pesananPesanan'));
    }

    public function create()
    {
        $barangBarang = Barang::all();
        return view('customer.pesanan.create', compact('barangBarang'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'barang_id' => ['required'],
            'jumlah' => ['required']
        ]);

        $validatedData['user_id'] = auth()->id();
        $barang = Barang::find($request->barang_id);
        $totalHarga = $barang->harga * $request->jumlah;
        if ($totalHarga < 2000000) {
            Alert::error("Gagal Pesan", "Minimal Pesanan 2.000.000. Pesanan Anda : Rp." . number_format($totalHarga));
            return back();
        }

        $validatedData['total_bayar'] = $totalHarga;

        Pesanan::create($validatedData);
        Alert::success("Berhasil", "Berhasil memesan barang");
        return redirect()->route('customer.pesanan.index');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return back();
    }
}

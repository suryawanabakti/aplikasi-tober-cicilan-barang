<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Keranjang;
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

    public function keranjang()
    {
        $keranjang = Keranjang::with('barang')->where('user_id', auth()->id())->whereNull('pesanan_id')->get();
        return view('customer.keranjang.index', compact('keranjang'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'barang_id' => ['required'],
            'jumlah' => ['required']
        ]);

        $validatedData['user_id'] = auth()->id();
        $barang = Barang::where('id', $request->barang_id)->first();
        $total = $barang->harga * $request->jumlah;
        $validatedData['total'] = $total;
        Keranjang::create($validatedData);

        Alert::success("Berhasil", "Berhasil menambah barang ke keranjang");
        return redirect()->route('customer.pesanan.create');
    }

    public function deleteKeranjang(Keranjang $keranjang)
    {
        $keranjang->delete();
        Alert::success("Berhasil Hapus Keranjang");
        return back();
    }

    public function storeTransaksi(Request $request)
    {
        $keranjang = Keranjang::with('barang')->where('user_id', auth()->id())->whereNull('pesanan_id');

        $totalHarga = $keranjang->sum('total');

        if ($totalHarga < 2000000) {
            Alert::error("Gagal Pesan", "Minimal Pesanan 2.000.000. Pesanan Anda : Rp." . number_format($totalHarga));
            return back();
        }

        if ($totalHarga > 5000000) {
            Alert::error("Gagal Pesan", "Maximal Pesanan 5.000.000. Pesanan Anda : Rp." . number_format($totalHarga));
            return back();
        }

        $pesanan =  Pesanan::create([
            'user_id' => auth()->id(),
            'total_bayar' => $totalHarga
        ]);

        $keranjang->update([
            'pesanan_id' => $pesanan->id
        ]);

        Alert::success("Pengajuan Kredit Berhasil");
        return redirect('/customer/pesanan');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return back();
    }
}

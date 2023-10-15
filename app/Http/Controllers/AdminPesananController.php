<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPesananController extends Controller
{
    public function index()
    {
        $pesananPesanan = Pesanan::orderBy('created_at', 'desc')->get();
        return view('admin.pesanan.index', compact('pesananPesanan'));
    }

    public function terima(Pesanan $pesanan, Request $request)
    {
        $request->validate([
            'jatuh_tempo' => 'required'
        ]);
        $pesanan->update([
            'status' => 'diterima',
            'jatuh_tempo' => $request->jatuh_tempo
        ]);
        $barang = Barang::where('id', $pesanan->barang_id)->first();
        $user =  User::where('id', $pesanan->user_id)->first();
        $tanggal = Carbon::createFromDate($request->jatuh_tempo)->format('d M Y');
        Controller::sendWa($user->phone, "Pesanan $barang->name diterima ✅. jatuh tempo tanggal  $tanggal");
        Alert::success("Berhasil", "Berhasil Menerima Pesanan Ini");
        return back();
    }


    public function tolak(Pesanan $pesanan)
    {
        $pesanan->delete();
        Alert::success("Berhasil", "Berhasil Menolak Pesanan Ini");
        return back();
    }
}

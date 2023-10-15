<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\User;

class AdminPembayaranController extends Controller
{
    public function index()
    {
        $pembayaranPembayaran = Pembayaran::orderBy('created_at', 'desc')->get();
        return view('admin.pembayaran.index', compact('pembayaranPembayaran'));
    }

    public function terima(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status' => 'diterima'
        ]);

        Pesanan::where('id', $pembayaran->pesanan_id)->update([
            'status_pembayaran' => 'lunas'
        ]);

        Controller::sendWa($pembayaran->user->phone, "Pembayaran Diterima");
        return back();
    }

    public function tolak(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status' => 'ditolak'
        ]);
        return back();
    }
}

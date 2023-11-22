<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function kirimPesanJatuhTempo()
    {
        $hariSekarang = Carbon::now('GMT+8')->addDay(1)->format('Y-m-d');
        $pesananJatuhTempo = Pesanan::where('status_pembayaran', 'belum lunas')->where('jatuh_tempo', '<=', $hariSekarang)->get();

        foreach ($pesananJatuhTempo as $pesanan) {
            Controller::sendWa($pesanan->user->phone, "Pesanan Jatuh Tempo");
        }

        return back();
    }
    public function index()
    {
        $totalCustomer = User::role('customer')->count();
        $totalBarang = Barang::count();
        $totalPesanan = Pesanan::where('hidden', false)->count();
        $totalPembayaranProses = Pembayaran::where('status', 'diproses')->count();

        $hariSekarang = Carbon::now('GMT+8')->addDay(1)->format('Y-m-d');
        $pesananJatuhTempo = Pesanan::where('status_pembayaran', 'belum lunas')->where('jatuh_tempo', '<=', $hariSekarang)->get();

        return view('admin.dashboard', compact('totalCustomer', 'totalBarang', 'totalPesanan', 'totalPembayaranProses', 'pesananJatuhTempo'));
    }
}

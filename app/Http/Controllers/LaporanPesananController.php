<?php

namespace App\Http\Controllers;

use App\Http\Resources\LaporanPesananResource;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanPesananController extends Controller
{
    public function index()
    {
        $pesananPesanan = Pesanan::orderBy('created_at', 'desc')->where('status_pembayaran', 'lunas')->get();
        return view('laporan.pesanan.index', compact('pesananPesanan'));
    }

    public function cetak()
    {
        $pesananPesanan = Pesanan::orderBy('created_at', 'desc')->get();
        $pdf = Pdf::loadView('laporan.pesanan.cetak', compact('pesananPesanan'));
        return $pdf->stream();
    }
}

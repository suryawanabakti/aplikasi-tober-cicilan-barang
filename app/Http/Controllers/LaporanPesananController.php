<?php

namespace App\Http\Controllers;

use App\Http\Resources\LaporanPesananResource;
use App\Models\Pesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanPesananController extends Controller
{
    public function index(Request $request)
    {
        $mulai = Carbon::now('GMT+8')->addDays(-7)->format('Y-m-d');
        $sampai = Carbon::now('GMT+8')->format('Y-m-d');
        $pesananPesanan = Pesanan::orderBy('created_at', 'desc')->where('status_pembayaran', 'lunas');
        if ($request->mulai && $request->sampai) {
            $mulai = $request->mulai;
            $sampai = $request->sampai;
        }
        $pesananPesanan->whereBetween(DB::raw('DATE(created_at)'), [$mulai, $sampai]);
        $pesananPesanan = $pesananPesanan->get();

        $diffTanggal = Carbon::createFromDate($mulai)->diffInDays($sampai);

        for ($i = 0; $i < $diffTanggal; $i++) {
            $chartTanggal[] = [
                "tanggal" => $tanggal = Carbon::createFromDate($mulai)->addDay($i)->format('Y-m-d'),
                "pemasukan" => Pesanan::whereDate('created_at', $tanggal)->sum('total_bayar')
            ];
        }

        return view('laporan.pesanan.index', compact('pesananPesanan', 'mulai', 'sampai', 'chartTanggal'));
    }

    public function cetak(Request $request)
    {
        $pesananPesanan = Pesanan::orderBy('created_at', 'desc')->where('status_pembayaran', 'lunas');

        $mulai = Carbon::now('GMT+8')->addDays(-7)->format('Y-m-d');
        $sampai = Carbon::now('GMT+8')->format('Y-m-d');
        if ($request->mulai && $request->sampai) {
            $mulai = $request->mulai;
            $sampai = $request->sampai;
        }
        $pesananPesanan->whereBetween(DB::raw('DATE(created_at)'), [$mulai, $sampai]);
        $pesananPesanan = $pesananPesanan->get();
        $pdf = Pdf::loadView('laporan.pesanan.cetak', compact('pesananPesanan'));
        return $pdf->stream();
    }
}

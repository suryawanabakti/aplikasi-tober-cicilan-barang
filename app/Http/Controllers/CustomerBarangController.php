<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class CustomerBarangController extends Controller
{
    public function index()
    {
        $barangBarang = Barang::orderBy('created_at', 'desc')->get();
        return view('customer.barang.index', compact('barangBarang'));
    }
}

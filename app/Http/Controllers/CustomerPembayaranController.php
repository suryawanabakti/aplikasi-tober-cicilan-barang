<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class CustomerPembayaranController extends Controller
{
    public function index()
    {
        $pembayaranPembayaran = Pembayaran::where('user_id', auth()->id())->get();
        return view('customer.pembayaran.index', compact('pembayaranPembayaran'));
    }

    public function store(Request $request, Pesanan $pesanan)
    {
        $validatedData = $request->validate([
            'bukti_transfer' => ['required', 'max:2048'],
        ]);
        $validatedData['user_id'] = auth()->id();
        $validatedData['pesanan_id'] = $pesanan->id;
        if ($request->bukti_transfer) {
            $imageName = time() . '.' . $request->bukti_transfer->extension();
            $request->bukti_transfer->move(public_path('storage/bukti_transfer'), $imageName);
            $validatedData['bukti_transfer'] = 'bukti_transfer/' . $imageName;
        }
        Pembayaran::create($validatedData);

        return redirect()->route('customer.pembayaran.index');
    }
}

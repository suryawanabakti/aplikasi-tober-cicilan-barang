@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold py-3 mb-4">Pengajuan Kredit</h4>
            <div class="mt-2">
                <a href="/customer/pesanan/keranjang" class="btn btn-primary mb-3 ">Keranjang
                    ({{ DB::table('keranjang')->where('user_id', auth()->id())->count() }})
                </a>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('customer.pesanan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        <b>SYARAT PENGAJUAN : </b> <br>
                                        - Minimal Pesanan Rp.2.000.000 <br>
                                        - Sudah Belanja Cash Minimal 3 kali <br>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="barang_id" class="form-label">Barang</label>
                                    <select name="barang_id" id="barang_id" class="form-select">
                                        @foreach ($barangBarang as $barang)
                                            <option value="{{ $barang->id }}">{{ $barang->nama }},
                                                Rp.{{ number_format($barang->harga) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Tambah Ke Keranjang 🚀</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Pengajuan Kredit</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('customer.pesanan.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        Minimal Pesanan Rp.2.000.000
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
                            <button class="btn btn-primary" type="submit">Ajukan 🚀</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

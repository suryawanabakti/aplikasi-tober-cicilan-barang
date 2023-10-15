@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-box text-success"></i>
                            </div>
                        </div>
                        <span>Total Customer</span>
                        <h3 class="card-title text-nowrap mb-1">
                            {{ $totalCustomer }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-box text-success"></i>
                            </div>
                        </div>
                        <span>Total Barang</span>
                        <h3 class="card-title text-nowrap mb-1">
                            {{ $totalBarang }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-box text-success"></i>
                            </div>
                        </div>
                        <span>Total Pesanan</span>
                        <h3 class="card-title text-nowrap mb-1">
                            {{ $totalPesanan }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <i class="bx bx-box text-success"></i>
                            </div>
                        </div>
                        <span>Pembayaran DiProses</span>
                        <h3 class="card-title text-nowrap mb-1">
                            {{ $totalPembayaranProses }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Pesanan Jatuh Tempo</h4>
                    <a href="/admin/kirim-pesan-jatuh-tempo" class="btn btn-warning ">Kirim Pesan Jatuh Tempo</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Pesanan</th>
                                <th>Jatuh Tempo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesananJatuhTempo as $pesanan)
                                <tr>
                                    <td>{{ $pesanan->user->name }}</td>
                                    <td>{{ $pesanan->barang->nama }}, {{ $pesanan->jumlah }}</td>
                                    <td>{{ \Carbon\Carbon::createFromDate($pesanan->jatuh_tempo)->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

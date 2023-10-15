@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Laporan </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="/laporan/pesanan/cetak" target="_blank" class="btn btn-primary btn-sm mb-3">Cetak</a>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Customer</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total Bayar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pesananPesanan as $pesanan)
                                        <tr>
                                            <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                                            <td>{{ $pesanan->user->name }}</td>
                                            <td>{{ $pesanan->barang->nama }}</td>
                                            <td>{{ $pesanan->barang->harga }}</td>
                                            <td>{{ $pesanan->jumlah }}</td>
                                            <td>{{ $pesanan->total_bayar }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>



    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        })
    </script>
@endpush

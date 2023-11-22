@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Pembayaran</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Pesanan</th>

                                        <th>Bukti Transfer</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pembayaranPembayaran as $pembayaran)
                                        <tr>
                                            <td>{{ $pembayaran->created_at->format('d M Y') }}</td>
                                            <td>
                                                @foreach ($pembayaran->pesanan->keranjang as $keranjang)
                                                    <div>{{ $keranjang->barang->nama }} * {{ $keranjang->jumlah }} =
                                                        {{ number_format($keranjang->total) }}</div>
                                                @endforeach
                                            </td>

                                            <td>
                                                <a target="_blank"
                                                    href="/storage/{{ $pembayaran->bukti_transfer }}">Lihat</a>
                                            </td>
                                            <td>{{ $pembayaran->status }}</td>
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

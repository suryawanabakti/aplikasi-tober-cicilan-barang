@extends('layouts.app')

@section('content')
    @php
        function statusPembayaran($status)
        {
            if ($status === 'diproses') {
                return '<span class="badge bg-warning">proses</span>';
            }
            if ($status === 'diterima') {
                return '<span class="badge bg-success">diterima</span>';
            }
            if ($status === 'ditolak') {
                return '<span class="badge bg-danger">ditolak</span>';
            }
        }
    @endphp
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
                                            <td>{{ $pembayaran->pesanan->barang->nama }}</td>

                                            <td>
                                                <a target="_blank"
                                                    href="/storage/{{ $pembayaran->bukti_transfer }}">Lihat</a>
                                            </td>
                                            <td>{!! statusPembayaran($pembayaran->status) !!}</td>
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

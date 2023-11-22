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
                                        <th>Customer</th>
                                        <th>Pesanan</th>

                                        <th>Bukti Transfer</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pembayaranPembayaran as $pembayaran)
                                        <tr>
                                            <td>{{ $pembayaran->user->name }}</td>
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
                                            <td>
                                                <a href="{{ route('admin.pembayaran.terima', $pembayaran->id) }}"
                                                    class="btn btn-success btn-sm">Terima</a>
                                                <a href="{{ route('admin.pembayaran.tolak', $pembayaran->id) }}"
                                                    class="btn btn-danger btn-sm">Tolak</a>

                                                @if ($pembayaran->status == 'diterima')
                                                    <a onclick="return confirm('Apakah anda yaking menghapus hutang ini?')"
                                                        href="{{ route('admin.pembayaran.hapus-utang', $pembayaran->id) }}"
                                                        class="btn btn-primary btn-sm">Hapus Hutang</a>
                                                @endif

                                            </td>
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

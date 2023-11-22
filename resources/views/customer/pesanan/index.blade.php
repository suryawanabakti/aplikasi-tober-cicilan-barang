@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Pesanan</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Tanggal</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Daftar Barang</th>
                                        <th>Total Bayar</th>

                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pesananPesanan as $pesanan)
                                        <tr>
                                            <td>
                                                @if ($pesanan->pembayaran->where('status', 'diterima')->first())
                                                    <span class="badge bg-success">Lunas</span>
                                                @else
                                                    @if ($pesanan->status == 'diterima')
                                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#bayar{{ $pesanan->id }}">Bayar</button>
                                                        <div class="modal fade" id="bayar{{ $pesanan->id }}" tabindex="-1"
                                                            aria-labelledby="bayarLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5"
                                                                            id="detailPembayaranLabel">
                                                                            Bayar</h1>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="{{ route('customer.pembayaran.store', $pesanan->id) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="mb-3">
                                                                                <label for=""
                                                                                    class="form-label">Tanggal</label>
                                                                                <input type="date" class="form-control"
                                                                                    value="{{ now()->format('Y-m-d') }}"
                                                                                    readonly>
                                                                            </div>


                                                                            <div class="mb-3">
                                                                                <label for=""
                                                                                    class="form-label">Bukti
                                                                                    Transfer</label>
                                                                                <input type="file" class="form-control"
                                                                                    name="bukti_transfer">
                                                                            </div>
                                                                            <button class="btn btn-primary"
                                                                                type="submit">Bayar</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#detailPembayaran{{ $pesanan->id }}">Detail
                                                        </button>
                                                    @endif
                                                @endif



                                                @if ($pesanan->status == 'proses')
                                                    <a href="{{ route('customer.pesanan.destroy', $pesanan->id) }}"
                                                        class="btn btn-danger btn-sm">Batalkan</a>
                                                @endif


                                                <div class="modal fade" id="detailPembayaran{{ $pesanan->id }}"
                                                    tabindex="-1" aria-labelledby="detailPembayaranLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="detailPembayaranLabel">
                                                                    Detail Pembayaran</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Tanggal Pembayaran</th>
                                                                            <th>Bukti</th>
                                                                            <th>Status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($pesanan->pembayaran as $pembayaran)
                                                                            <tr>
                                                                                <td>{{ $pembayaran->created_at->format('d M Y') }}
                                                                                </td>
                                                                                <td>
                                                                                    <a target="_blank"
                                                                                        href="/storage/{{ $pembayaran->bukti_transfer }}">Lihat</a>
                                                                                </td>
                                                                                <td>
                                                                                    {{ $pembayaran->status }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::createFromDate($pesanan->jatuh_tempo)->format('d M Y') ?? '-' }}
                                            </td>
                                            <td>
                                                @foreach ($pesanan->keranjang as $keranjang)
                                                    <div>{{ $keranjang->barang->nama }} * {{ $keranjang->jumlah }} =
                                                        {{ number_format($keranjang->total) }}</div>
                                                @endforeach
                                            </td>

                                            <td>Rp.{{ number_format($pesanan->total_bayar) }}</td>
                                            <td>{{ $pesanan->status }}</td>
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

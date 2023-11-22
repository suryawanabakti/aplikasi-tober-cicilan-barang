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
                                        <th>Customer</th>
                                        <th>Daftar Barang</th>

                                        <th>Total Bayar</th>
                                        <th>Sisa Bayar</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pesananPesanan as $pesanan)
                                        <tr>
                                            <td>
                                                @if ($pesanan->status == 'proses')
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        Terima
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                                        data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Pesanan
                                                                        {{ $pesanan->user->name }}</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="/admin/pesanan/{{ $pesanan->id }}/terima">
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="" class="form-label">Beri
                                                                                Tanggal Jatuh Tempo</label>
                                                                            <input type="date" required
                                                                                class="form-control" name="jatuh_tempo">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-success">Terima Pesanan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="/admin/pesanan/{{ $pesanan->id }}/tolak"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah anda yaking menolak pesanan ini ?')">Tolak</a>
                                                @endif

                                                @if ($pesanan->status == 'diterima')
                                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#detailPembayaran">Detail Pembayaran</button>
                                                    <div class="modal fade" id="detailPembayaran" tabindex="-1"
                                                        aria-labelledby="detailPembayaranLabel" aria-hidden="true">
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
                                                @endif
                                            </td>
                                            <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                                            <td>{{ \Carbon\Carbon::createFromDate($pesanan->jatuh_tempo)->format('d M Y') ?? '-' }}
                                            </td>
                                            <td>{{ $pesanan->user->name }}</td>
                                            <td>
                                                @foreach ($pesanan->keranjang as $keranjang)
                                                    <div>{{ $keranjang->barang->nama }} * {{ $keranjang->jumlah }} =
                                                        {{ number_format($keranjang->total) }}</div>
                                                @endforeach
                                            </td>

                                            <td>Rp.{{ number_format($pesanan->total_bayar) }}</td>
                                            <td>Rp.
                                                {{ number_format($pesanan->total_bayar - $pesanan->pembayaran->where('status', 'diterima')->sum('jumlah_bayar')) }}
                                            </td>
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

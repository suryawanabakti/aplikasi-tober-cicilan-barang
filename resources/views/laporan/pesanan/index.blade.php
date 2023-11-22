@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Laporan </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Mulai</label>
                                        <input type="date" class="form-control" name="mulai"
                                            value="{{ $mulai }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Sampai</label>
                                        <input type="date" class="form-control" name="sampai"
                                            value="{{ $sampai }}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                </div>
                                <div class="col-md-2">

                                    <a href="/laporan/pesanan/cetak?mulai={{ $mulai }}&sampai={{ $sampai }}"
                                        class="btn btn-primary mt-4" target="_blank">Cetak</a>

                                </div>
                            </div>
                        </form>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Customer</th>
                                        <th>Daftar Barang</th>
                                        <th>Total Bayar</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pesananPesanan as $pesanan)
                                        <tr>
                                            <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                                            <td>{{ $pesanan->user->name }}</td>
                                            <td>
                                                @foreach ($pesanan->keranjang as $keranjang)
                                                    <div>{{ $keranjang->barang->nama }} * {{ $keranjang->jumlah }} =
                                                        {{ number_format($keranjang->total) }}</div>
                                                @endforeach
                                            </td>
                                            <td>{{ $pesanan->total_bayar }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>
            <div class="col-md-12">
                <div id="chart">
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

        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'sales',
                data: [
                    @foreach ($chartTanggal as $data)
                        '{{ $data['pemasukan'] }}',
                    @endforeach
                ]
            }],
            xaxis: {
                categories: [
                    @foreach ($chartTanggal as $data)
                        '{{ $data['tanggal'] }}',
                    @endforeach
                ]
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
@endpush

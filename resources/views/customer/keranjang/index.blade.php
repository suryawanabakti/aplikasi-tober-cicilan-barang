@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Keranjang</h4>

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keranjang as $data)
                                        <tr>
                                            <td>{{ $data->barang->nama }}</td>
                                            <td>{{ $data->barang->harga }}</td>
                                            <td>{{ $data->jumlah }}</td>
                                            <td>{{ $data->total }}</td>
                                            <td>
                                                <a href="/keranjang/delete/{{ $data->id }}"
                                                    class="btn btn-sm btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Total Bayar</td>
                                        <td>{{ number_format($keranjang->sum('total')) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="/customer/pesanan-store" onclick="return confirm('Apakah anda yakin mengajukan kredit ?')"
                    class="btn btn-primary mt-2">Ajukan Kredit</a>

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

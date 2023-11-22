@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Barang</h4>

        <div class="row">
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahBarang">
                    Tambah Barang
                </button>

                <!-- Modal -->
                <div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="tambahBarangLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="tambahBarangLabel">Tambah Barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="kode">Kode</label>
                                            <input type="text" class="form-control" name="kode">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="satuan">Satuan</label>
                                            <select name="satuan" id="satuan" class="form-select">
                                                <option value="pcs">Pieces</option>
                                                <option value="kilogram">Kilogram</option>
                                                <option value="pak">Pak</option>
                                                <option value="dos">Dos</option>
                                                <option value="zak">Zak</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="harga">Harga</label>
                                            <input type="text" class="form-control" name="harga">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" name="stok">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="gambar">Gambar</label>
                                            <input type="file" class="form-control" name="gambar">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah Barang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Stok</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($barangBarang as $barang)
                                        <tr>
                                            <td>{{ $barang->nama }} <br> </td>
                                            <td>{{ $barang->stok }}</td>
                                            <td>{{ $barang->satuan }}</td>
                                            <td>Rp.{{ number_format($barang->harga) }}</td>
                                            <td><img src="/storage/{{ $barang->gambar }}" alt="Gambar" width="200px">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.barang.destroy', $barang->id) }}"
                                                    class="btn btn-danger btn-sm">Hapus</a>
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

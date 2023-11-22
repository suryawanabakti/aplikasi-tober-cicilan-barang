@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Master Data /</span> Customer</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Nik</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Foto</th>
                                        <th>KTP</th>
                                        <th>Alamat</th>
                                        @role('pimpinan')
                                            <th>Aksi</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->nik }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>
                                                <img src="/storage/{{ $customer->foto }}" width="100" alt="">
                                            </td>
                                            <td>
                                                <a class="btn btn-info btn-sm" target="_blank"
                                                    href="/storage/{{ $customer->ktp }}">Lihat</a>
                                            </td>
                                            <td>{{ $customer->alamat }}</td>
                                            @role('pimpinan')
                                                <td>
                                                    <a href="{{ route('admin.customers.destroy', $customer->uuid) }}"
                                                        onclick="return confirm('Menghapus user ini akan menghapus semua data dari user tersebut. Apakah anda yakin?')"
                                                        class="btn btn-danger btn-sm">Hapus</a>
                                                </td>
                                            @endrole
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Laporan Tober</h4>
            <h6><a target="_blank" href="{{ url('/') }}">{{ url('/') }}</a></h6>
        </h5>
    </center>
    <table class="table table-bordered" id="myTable">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Toko</th>
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

                    <td>Rp.{{ number_format($pesanan->total_bayar) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>

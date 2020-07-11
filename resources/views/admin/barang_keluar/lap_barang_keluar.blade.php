<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Cetak Barang Keluar</title>
</head>
<body>
    <div class="container-fluid">
        <h3 class="text-center font-weight-bold"> Laporan Barang Keluar Bulan {{$bulan}}</h3>
        <h3 class="text-center font-weight-bold">Bintang Footwear</h3>
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Tanggal Masuk</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)
                        <tr>
                            <th scope="row">{{ $row->kd_barang }}</th>
                            <td>{{$row->tanggal_keluar}}</td>
                            <td>{{$row->nm_barang}}</td>
                            <td class="text-center">{{$row->jumlah_barang_keluar}}</td>
                            <td>{{$row->keterangan_barang_keluar}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>Dicetak Tanggal {{ date('Y-m-d H:i:s') }}</p>
                <p>Oleh : {{ session('name') }}</p>
                <p>Total Barang Keluar : {{$total}}</p>
            </div>
        </div>  
    </div>
</body>
</html>
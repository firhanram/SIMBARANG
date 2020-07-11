@extends('layouts.app')

@section('body-class','class=sidebar-mini')

@section('main')
    <div class="wrapper">
        {{-- topbar --}}
        @include('layouts.topbar')
        {{-- sidebar --}}
        @include('layouts.sidebar')

        {{-- content-wrapper --}}
        <div class="content-wrapper">
            {{-- main content --}}
            <div class="content">
                <div class="container-fluid">
                    <a href="{{ url('barang_masuk/tambah_barang_masuk') }}" class="btn btn-primary mt-3"><i class="fas fa-user-plus mr-2"></i>Input Barang Masuk</a>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header ">
                                    <h6 class="card-title">Data Barang Masuk</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="table_barang_masuk" >
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Tanggal Masuk</th>
                                                    <th>Jumlah</th>
                                                    <th>Supplier</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($barangMasuk as $row)
                                                    <tr>
                                                        <td>{{$row->kd_barang}}</td>
                                                        <td>{{$row->nm_barang}}</td>
                                                        <td>{{$row->tanggal_masuk}}</td>
                                                        <td class="text-center">{{$row->jumlah_barang_masuk}}</td>
                                                        <td>{{$row->nm_supplier}}</td>
                                                        <td>{{$row->keterangan_barang_masuk}}</td>
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
            </div>
            {{-- /main content --}}
        </div>
        {{-- /content wrapper --}}
    </div>
    {{-- /wrapper --}}
@endsection

@section('js')

   @if (session('success'))
   <script>
       Swal.fire(
        'Berhasil',
        "{{session('success')}}",
        'success'
       );
   </script>
   @elseif(session('error'))
   <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
        });
    </script>
   @endif

   <script>
       $(document).ready(function() {
            $('#table_barang_masuk').DataTable({
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                    }
                ]
            });
        });
   </script>
@endsection
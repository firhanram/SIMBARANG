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
                    <a href="{{ url('barang/tambah_barang') }}" class="btn btn-primary mt-3"><i class="fas fa-user-plus mr-2"></i>Input Barang</a>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header ">
                                    <h6 class="card-title">Data Barang</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="table_items" >
                                            <thead>
                                                <tr class="text-center">
                                                    <th>Kode Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jenis</th>
                                                    <th>Kategori</th>
                                                    <th>Satuan</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td>{{$item->kd_barang}}</td>
                                                        <td>{{$item->nm_barang}}</td>
                                                        <td>{{$item->nm_jenis}}</td>
                                                        <td>{{$item->nm_kategori}}</td>
                                                        <td>{{$item->nm_satuan}}</td>
                                                        <td>{{$formatRupiah->formatRupiah($item->harga_barang)}}</td>
                                                        <td class="text-center">{{$item->stok_barang}}</td>
                                                        <td class="text-center">
                                                            <a href="{{url('barang/edit_barang/'.$item->kd_barang)}}" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{url('barang/delete_barang/'.$item->kd_barang)}}" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
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
            $('#table_items').DataTable({
                pageLength : 5,
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
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
                    <a href="{{ url('jenis/tambah_jenis') }}" class="btn btn-primary mt-3"><i class="fas fa-user-plus mr-2"></i>Input Jenis</a>
                    <div class="row mt-3">
                        <div class="col-sm-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header ">
                                    <h6 class="card-title">Data Jenis</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="table_types" >
                                            <thead>
                                                <tr class="text-center">
                                                    <th style="width: 10%">No</th>
                                                    <th>Nama Jenis</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($types as $type)
                                                    <tr>
                                                        <td class="text-center">{{$loop->iteration}}</td>
                                                        <td>{{$type->nm_jenis}}</td>
                                                        <td class="text-center">
                                                            <a href="{{url('jenis/edit_jenis/'.$type->kd_jenis)}}" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{url('jenis/delete_jenis/'.$type->kd_jenis)}}" class="btn btn-danger btn-sm">
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
            $('#table_types').DataTable({
                columnDefs:[
                    {
                        orderable:false,
                        targets:[2],
                        searchable:false
                    }
                ]
            });
        });
   </script>
@endsection
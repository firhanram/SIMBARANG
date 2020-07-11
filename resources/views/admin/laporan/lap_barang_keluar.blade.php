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
                    <div class="row pt-3">
                        <div class="col-sm-6 m-auto">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h6 class="card-title">Laporan Barang Keluar</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{url('/lap_barang_keluar/cetak')}}" method="POST">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-file-download"></i>
                                                </span>
                                            </div>
                                            <select name="bulan" class="form-control custom-select"> 
                                                <option value="" selected disabled>Pilih Bulan</option>
                                                <option value="January">January</option>
                                                <option value="Febuary">Febuary</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="June">June</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                        </div>
                                        <div class="row justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-2">Cetak</button>
                                            <a href="{{ url('/dashboard') }}" class="btn btn-warning d-block mr-2">Kembali</a>
                                        </div>
                                    </form>
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
@endsection

@section('js')

    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('error') }}",
        });
    </script>
    @endif
@endsection
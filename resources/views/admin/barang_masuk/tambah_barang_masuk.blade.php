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
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h6 class="card-title">Input Barang Masuk</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/barang_masuk/tambah_barang_masuk/add') }}" method="POST">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-boxes"></i>
                                                </span>
                                            </div>
                                            <select name="kd_barang" class="form-control custom-select @error('kd_barang') is-invalid @enderror" required> 
                                                <option value="" selected disabled>Pilih Barang</option>
                                                @foreach($items as $item)
                                                    <option value="{{$item->kd_barang}}">{{$item->kd_barang.' | '.$item->nm_barang}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Tidak Boleh Kosong!
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Tidak Boleh Kosong!
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-truck-loading"></i>
                                                </span>
                                            </div>
                                            <input type="number" name="qty" class="form-control" placeholder="Jumlah">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-truck"></i>
                                                </span>
                                            </div>
                                            <select name="supplier" class="form-control custom-select"> 
                                                <option value="" selected disabled>Pilih Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{$supplier->kd_supplier}}">{{$supplier->nm_supplier}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-info-circle"></i>
                                                </span>
                                            </div>
                                            <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                                        </div>
                                        <div class="row justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <a href="{{ url('/barang_masuk') }}" class="btn btn-warning d-block mr-2">Kembali</a>
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
    {{-- /wrapper --}}
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

   <script>
      
   </script>
@endsection
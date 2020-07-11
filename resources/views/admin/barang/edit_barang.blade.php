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
                        <div class="col-sm-8 m-auto">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h6 class="card-title">Input Barang</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/barang/edit_barang/update') }}" method="POST" class="needs-validation" novalidate>
                                        @csrf
                                        
                                        @foreach($item as $row)
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-qrcode"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="kd_barang" value="{{$row->kd_barang}}" required readonly>
                                                    <div class="invalid-feedback">
                                                        Tidak Boleh Kosong!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-boxes"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="nm_barang" value="{{$row->nm_barang}}" placeholder="Nama Barang" required>
                                                    <div class="invalid-feedback">
                                                        Tidak Boleh Kosong!
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        @endforeach
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tags"></i>
                                                        </span>
                                                    </div>
                                                    <select name="kategori" class="form-control custom-select">
                                                        <option value="" selected disabled>Pilih Kategori</option>
                                                        @foreach($categories as $row)
                                                            <option value="{{$row->kd_kategori}}">{{$row->nm_kategori}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tags"></i>
                                                        </span>
                                                    </div>
                                                    <select name="jenis" class="form-control custom-select">
                                                        <option value="" selected disabled>Pilih Jenis</option>
                                                        @foreach($types as $row)
                                                            <option value="{{$row->kd_jenis}}">{{$row->nm_jenis}}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Tidak Boleh Kosong!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-4">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tags"></i>
                                                        </span>
                                                    </div>
                                                    <select name="satuan" class="form-control custom-select">
                                                        <option value="" selected disabled>Pilih Satuan</option>
                                                        @foreach($units as $row)
                                                            <option value="{{$row->kd_satuan}}">{{$row->nm_satuan}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @foreach($item as $row)
                                            <div class="form-group col-sm-4">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            Rp
                                                        </span>
                                                    </div>
                                                    <input type="number" name="harga_barang" placeholder="Harga" value="{{$row->harga_barang}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tags"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" name="stok_barang" value="{{$row->stok_barang}}" placeholder="Jumlah" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach                             
                                        <div class="row justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <a href="{{ url('/barang') }}" class="btn btn-warning d-block mr-2">Kembali</a>
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
       (function() {
        'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
        })();
   </script>
@endsection
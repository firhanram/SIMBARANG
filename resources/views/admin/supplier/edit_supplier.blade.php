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
                                    <h6 class="card-title">Input Supplier</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/supplier/edit_supplier/update') }}" method="POST" class="needs-validation" novalidate>
                                        @csrf

                                        @foreach($supplier as $row)
                                        <input type="text" name="kd_supplier" value="{{$row->kd_supplier}}" hidden>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-truck"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="nm_supplier" value="{{$row->nm_supplier}}" required>
                                            <div class="invalid-feedback">
                                                Tidak Boleh Kosong!
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                </span>
                                            </div>
                                            <textarea name="alamat" class="form-control">{{$row->alamat_supplier}}</textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-phone-square-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" name="no_telp" value="{{$row->no_telp_supplier}}">
                                        </div>
                                        @endforeach
                                        <div class="row justify-content-end">
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <a href="{{ url('/supplier') }}" class="btn btn-warning d-block mr-2">Kembali</a>
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
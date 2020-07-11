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
                                    <h6 class="card-title">Input Barang Keluar</h6>
                                </div>
                                <div class="card-body">
                                    <form action="{{ url('/barang_keluar/tambah_barang_keluar/add') }}" method="POST">
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
                                                    <option value="{{$item->kd_barang}}" id="barang" data-jumlah="{{$item->stok_barang}}">{{$item->kd_barang.' | '.$item->nm_barang}}</option>
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
                                            <input type="date" name="tanggal_keluar" class="form-control @error('tanggal_keluar') is-invalid @enderror" required>
                                        </div>
                                        <div class="invalid-feedback">
                                            Tidak Boleh Kosong!
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-box"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" id="stok_awal" name="stok_awal" class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fab fa-dropbox"></i>
                                                        </span>
                                                    </div>
                                                    <input type="number" name="qty" class="form-control" placeholder="Jumlah Keluar">
                                                </div>
                                            </div>
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
                                            <a href="{{ url('/barang_keluar') }}" class="btn btn-warning d-block mr-2">Kembali</a>
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
      $(document).ready(function() {
          $(document).on('click','#barang',function(){
              let stok_awal = $(this).data('jumlah');

              $('#stok_awal').val(stok_awal);

              console.log(stok_awal);
          });
      });
   </script>
@endsection
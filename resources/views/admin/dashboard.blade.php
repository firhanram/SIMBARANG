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
                    <h5 class="mb-3 pt-3">Dashboard</h5>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="fas fa-boxes"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Barang</span>
                                    <span class="info-box-number">{{$totalItem}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">User</span>
                                    <span class="info-box-number">{{$totalUser}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h6 class="card-title">Grafik Barang Masuk</h6>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                   <div class="chart">
                                       <canvas id="chartBarangMasuk"></canvas>
                                   </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h6 class="card-title">Grafik Barang Keluar</h6>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                   <div class="chart">
                                       <canvas id="chartBarangKeluar"></canvas>
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
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            const barangMasuk = {
                runChart : function(){
                    this.ajaxGetData();
                },

                ajaxGetData : function(){
                    const url = "{{url('chartBarangMasukBulanan')}}";
                    const request = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'GET',
                        url: url
                    });

                    request.done(function(response){
                        console.log(response);
                        barangMasuk.createChart(response);
                    });
                }, 

                createChart : function(response){
                    const ctx = $('#chartBarangMasuk')
                    const chartBarangMasuk = new Chart(ctx, {
                        type : 'bar',
                        data : {
                            labels : response.bulan,
                            datasets : [{
                                label : 'Grafik Barang Masuk',
                                data : response.data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        }, 
                        options : {
                            scales : {
                                yAxes : [{
                                    ticks : {
                                        beginAtZero : true
                                    }
                                }]
                            }
                        }
                    });
                }
            }

            const barangKeluar = {
                runChart : function(){
                    this.ajaxGetData();
                },

                ajaxGetData : function(){
                    const url = "{{url('chartBarangKeluarBulanan')}}";
                    const request = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'GET',
                        url: url
                    });

                    request.done(function(response){
                        console.log(response);
                        barangKeluar.createChart(response);
                    });
                }, 

                createChart : function(response){
                    const ctx = $('#chartBarangKeluar')
                    const chartBarangKeluar = new Chart(ctx, {
                        type : 'bar',
                        data : {
                            labels : response.bulan,
                            datasets : [{
                                label : 'Grafik Barang Keluar',
                                data : response.data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        }, 
                        options : {
                            scales : {
                                yAxes : [{
                                    ticks : {
                                        precision : 0,
                                        beginAtZero : true
                                    }
                                }]
                            }
                        }
                    });
                }
            }

            barangKeluar.runChart();
            barangMasuk.runChart();
        });
    </script>
@endsection
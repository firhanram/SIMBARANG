<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Bintang Footwear</title>
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/css/adminlte.min.css') }}">
  {{-- Data Table Boostrap --}}
  <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  {{-- Data Table Responsive --}}
  <link rel="stylesheet" href="{{ asset('/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
   <!-- jQuery -->
   <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
   {{-- DataTables --}}
  <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  {{-- Chart.js--}}
  <link rel="stylesheet" href="{{asset('admin/plugins/chartjs/Chart.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- Sweet Alert 2 --}}
  <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert2/sweetalert2.min.css') }}">
  @yield('header')
</head>

<body @yield('body-class')>

  {{-- main content --}}
  @yield('main')
  <!-- Bootstrap 4 -->
  <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('admin/js/adminlte.min.js') }}"></script>
  {{-- Sweet Alert 2 --}}
  <script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
  {{-- DataTables Boostrap 4 --}}
  <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  {{-- DataTables Responsive --}}
  <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
   {{-- Chart.Js --}}
   <script src="{{asset('admin/plugins/chartjs/Chart.min.js')}}"></script>
  {{-- extra js --}}
  @yield('js')

</body>

</html>

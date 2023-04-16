<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href=" {{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href=" {{ asset('admin/dist/css/adminlte.min.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href=" {{ asset('admin//plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('admin//plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href=" {{ asset('admin//plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts._navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts._sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content-wrapper')
    
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('content')
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('layouts._footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src=" {{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src=" {{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src=" {{ asset('admin/dist/js/adminlte.js') }}"></script>

<!-- datatables-->
<script src=" {{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src=" {{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src=" {{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src=" {{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src=" {{ asset('admin/dist/js/demo.js') }}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src=" {{ asset('admin/dist/js/pages/dashboard3.js') }}"></script>

@yield('script-js')

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'UTS Laravel Starter Code') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte2/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Datatables --}}
    <link rel="stylesheet" href="{{ asset('adminlte2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte2/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- SweetAlert2 --}}
    {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('adminlte2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte2/dist/css/adminlte.min.css') }}">

    @stack('css')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
        <a href="{{ url('/') }}" class="brand-link d-flex align-items-center">
            <img src="{{ asset('adminlte2/dist/img/logo2.png') }}" alt="logo2"
                style="width: 50px; height: 50px; opacity: .9; margin-right: 10px;" class="img-circle elevation-3">
            <span class="brand-text font-weight-light" style="font-size: 1.50rem;">Alyssa & Co.</span>
        </a>

            <!-- Sidebar -->
            @include('layouts.sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @include('layouts.breadcrumb')

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte2/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/3b26e74800.js" crossorigin="anonymous"></script>

    <!-- DataTables & Plugins -->
    <script src="{{ asset('adminlte2/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


    <!-- jquery-validation -->
    <script src="{{ asset('adminlte2/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('adminlte2/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte2/plugins/sweetalert2/sweetalert2.min.css')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte2/dist/js/adminlte.min.js') }}"></script>

    <script>
        // Untuk mengirimkan token Laravel CSRF pada setiap request ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @stack('js') <!-- Digunakan untuk menangkap custom js dari perintah push('js') pada masing-masing view -->
</body>

</html>
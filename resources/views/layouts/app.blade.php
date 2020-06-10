<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="{{ asset('./css/nucleo-icons.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{ asset('./css/dashboard.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

  <style>
      .main-panel {
          border-top: none;
          background: #f5f5f5 !important;
      }
      .sidebar, .off-canvas-sidebar {
          box-shadow: -1px -11px 8px 3px rgb(243, 243, 243);
      }
      .navbar {
        box-shadow: -1px -11px 8px 3px rgba(194, 188, 188, 0.6);
      }
      .sidebar .nav p {
        font-size: 1rem;
        text-transform: capitalize;
        color: #000;
      }
      .sidebar {
          background: #FFF !important;
      }
      .sidebar .logo .simple-text {
          color: #000 !important;
      }
      .bg-light {
        background: #f5f5f5 !important
      }
      .table-action-icon {
        font-size: 20px;
        text-decoration: none;
        color: #CDCCD6;
      }
      table.dataTable.no-footer, table.dataTable tfoot td, table.dataTable.display tbody, table.dataTable.cell-border tbody td,td {
          border: none !important;
      }
      .tr-border-left {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
      }
      .tr-border-right {
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
      }
      td {
        margin-top: 10px;
        margin-bottom: 10px;
      }
      .card label {
          color: #000;
      }
      .form-control, textarea, .form--control:focus, .form--control:focus-within {
          background: #FFF !important;
          color: #000 !important;
      }
  </style>

</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            @include('components.sidebar')
        </div>

        <div class="main-panel">
            @include('components.navbar')
            @yield('content')
            @include('components.footer')
        </div>
    </div>
    <script src="{{ asset('./js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('./js/core/popper.min.js') }}"></script>
    <script src="{{ asset('./js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('./js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('./js/plugins/bootstrap-notify.js') }}"></script>
    <script src="{{ asset('./js/dashboard.js') }}"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

    <script>
        // $(document).ready( function () {
        //     $('#employees-table').DataTable();
        // } );
    </script>
    
    @yield('js-script')
</body>
</html>

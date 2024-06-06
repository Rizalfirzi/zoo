<!doctype html>
<html lang="id" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

<head>

  <meta charset="utf-8" />
  <title>Admin Zoo</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
  <meta content="Themesbrand" name="author" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('assets_login/images/favicon.png') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap"> --}}
  <link rel="stylesheet" href="{{ asset('plugin/googleapisApp.css') }}">

  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('plugin/flatpickr.min.css') }}">
  <style>
    .symbol .symbol-label {
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 500;
        color: #3f4254;
        background-color: #f5f8fa;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        border-radius: 0.475rem;
        width: 50px;
        height: 50px;
    }
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Memberikan latar belakang transparan */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999; /* Menempatkan elemen di atas konten lain */
        backdrop-filter: blur(5px); /* Menambahkan efek blur pada elemen di bawahnya */
    }

    .indicator-proses {
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
  </style>
  <!-- custom CSS-->
  @stack('plugin-css')
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> --}}
  <link rel="stylesheet" href="{{ asset('plugin/googleapisInter.css') }}" />

  <!-- Layout config Js -->
  <script src="{{ asset('assets/js/layout.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/izitoast.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/select2.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" />
  <!-- Bootstrap CSS -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Icons CSS -->
  <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- App CSS-->
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- custom CSS-->
  <!-- HighChart-->
  <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

  <!--datatable css-->
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" /> --}}
  <link rel="stylesheet" href="{{ asset('plugin/bootstrap5.min.css') }}" />

  <!--datatable responsive css-->
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" /> --}}
  <link rel="stylesheet" href="{{ asset('plugin/responsive.bootstrap.min.css') }}" />

  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"> --}}
  <link rel="stylesheet" href="{{ asset('plugin/buttons.dataTables.min.css') }}">





  @stack('css')

</head>

<body>
  <div class="overlay" style="display: none;">
    <div class="indicator-proses">
        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
    </div>
  </div>
  <!-- Begin page -->
  <div id="layout-wrapper">

    <x-dashboard.topbar />
    <!-- ========== App Menu ========== -->
    <x-dashboard.sidebar />
    <!-- Left Sidebar End -->
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content" >

      <div class="page-content" id="background-pimpinan">
        <div class="container-fluid" >

          <!-- start page title -->
          <div class="row">
            <div class="col-12">
              @yield('breadcrumb')
            </div>
          </div>
          <!-- end page title -->
          @yield('content')

        </div>
        <!-- container-fluid -->
      </div>
      <!-- End Page-content -->

      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <script>
                document.write(new Date().getFullYear())
              </script> © DKPP.
            </div>
            {{-- <div class="col-sm-6">
              <div class="text-sm-end d-none d-sm-block">
                Design & Develop by Themesbrand
              </div>
            </div> --}}
          </div>
        </div>
      </footer>
    </div>
    <!-- end main content-->

  </div>
  <!-- END layout-wrapper -->



  <!--start back-to-top-->
  <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
  </button>
  <!--end back-to-top-->

  <button>
    {{-- <div class="customizer-setting d-none d-md-block">
      <div class="btn-info btn-rounded shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
        <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
      </div>
    </div> --}}
  </button>


  <!-- Theme Settings -->
  <x-dashboard.theme-settings />

  <!-- JAVASCRIPT -->
  <script>var hostUrl = "assets/";</script>

  <!-- App js -->
  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
  <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
  <script src="{{ asset('assets/js/plugins.js') }}"></script>

  {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('plugin/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/highchart11/code/highcharts.js') }}"></script>
  <script src="{{ asset('assets/highchart11/code/highcharts-3d.js') }}"></script>

  <!--datatable js-->
  {{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
  <script src="{{ asset('plugin/jquery.dataTables.min.js') }}"></script>
  {{-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> --}}
  <script src="{{ asset('plugin/dataTables.bootstrap5.min.js') }}"></script>
  {{-- <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> --}}
  <script src="{{ asset('plugin/dataTables.responsive.min.js') }}"></script>
  {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> --}}
  <script src="{{ asset('plugin/dataTables.buttons.min.js') }}"></script>
  {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> --}}
  <script src="{{ asset('plugin/buttons.print.min.js') }}"></script>
  {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script> --}}
  <script src="{{ asset('plugin/buttons.html5.min.js') }}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
  <script src="{{ asset('plugin/vfs_fonts.js') }}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
  <script src="{{ asset('plugin/pdfmake.min.js') }}"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}
  <script src="{{ asset('plugin/jszip.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="{{asset('js/izitoast.js')}}"></script>
  <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
  <script src="{{asset('js/select2.js')}}"></script>
  <script src="{{asset('plugin/moment/moment.js')}}"></script>
  <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
  <!-- App js -->
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <script src="{{ asset('js/app/plugin.js')}}"></script>
  <script src="{{ asset('js/app/method.js')}}"></script>
  <!-- custom JS-->
  @stack('script')
  @stack('script_processing')
</body>

</html>

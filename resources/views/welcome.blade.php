<!DOCTYPE html>

<html lang="id">
<!--begin::Head-->

<head>

    <title>Dewan Kehormatan Penyelenggara Pemilu</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logo_dkpp.jpeg') }}">
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used by this page)-->
    <link href="{{ asset('assets_templete/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets_templete/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets_templete/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets_templete/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <link href="{{ asset('assets_templete/css/posko.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" type="text/css" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body data-kt-name="metronic" id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" data-kt-app-sidebar-minimize="on"
    class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        if (document.documentElement) {
            const defaultThemeMode = "dark";
            const name = document.body.getAttribute("data-kt-name");
            let themeMode = localStorage.getItem("kt_" + (name !== null ? name + "_" : "") + "theme_mode_value");
            if (themeMode === null) {
                if (defaultThemeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <style>
        .breadcrumb-item {
            font-family: Poppins-Regular;
        }

        .font-poppins {
            font-family: Poppins-Regular;
            font-size: 12px;
            color: #5d5e66;
        }

        .breadcrumb-item:after {
            content: "\00a0/" !important;
        }

        .card span {
            font-family: Poppins-Regular;
            font-size: 15px;
        }
        #close_prov {
            font-family: Poppins-Regular;
            font-size: 25px;
        }
    </style>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->


    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            <div id="kt_app_header" class="app-header" style="left:0;">
                <div class="app-container container-fluid d-flex align-items-stretch justify-content-between nvab">
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 justify-content-start">
                        <a href="{{ url('landing_page') }}" class="d-lg-none">
                            <img alt="Logo" src="{{ asset('assets/images/logo_dkpp.jpeg') }}" class="h-40px" />
                        </a>
                        <h1 class="ms-3 nav-zoom d-lg-none" style="font-size: 50px"> {{ __('DKPP') }} </h1>
                    </div>
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 justify-content-end">
                        <span class="d-lg-none mn-sidebar" style="font-size:30px;cursor:pointer; color:aliceblue;"
                            onclick="toggleNav()">&#9776;</span>
                    </div>
                    <div id="mySidenav" class="d-lg-none sidenav warnacard">
                        <div class="row mb-5">
                            <div class="nav-menu-sidebar">
                                <a href="javascript:void(0)" style="height: 50px; width:50px; padding:0px;" class="closebtn btn" onclick="closeNav()">&times;</a>
                            </div>
                        </div>
                        <div class="row">
                            @if (Route::has('login'))
                            @auth
                            @php
                                $route_get = App\Models\User::GetFirstRoute()->first();
                            @endphp
                            <a href="{{ route($route_get->route) }}" class="btn text-center btn-custom btn-icon-muted btn-active-info btn-active-color-info custom-button text-white fs-5">{{ $route_get->name}}</a>
                            @else
                            <a href="{{ route('login') }}" class="btn text-center btn-custom btn-icon-muted btn-active-info btn-active-color-info custom-button text-white fs-5">Login</a>
                            {{-- <a href="{{ route('register') }}" class="btn text-center btn-custom btn-icon-muted btn-active-info btn-active-color-info custom-button text-white fs-5">Register</a> --}}
                            @endauth
                            @endif
                        </div>
                        <hr>

                        <!-- Bagian ikon sejajar -->
                        <div class="row justify-content-center">
                            <div class="col-12 text-center">

                            </div>

                            <div class="col-4 text-center">
                                <!-- Ikon kedua -->

                            </div>

                            <div class="col-4 text-center">
                                <!-- Ikon ketiga -->

                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                        id="kt_app_header_wrapper">
                        <!--begin::Menu wrapper-->
                        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                            data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                            data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="end"
                            data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                            data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                            data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                            <!--begin::Menu-->
                            <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold"
                                id="kt_app_header_menu" data-kt-menu="true">
                                <!--begin:Menu item-->
                                <div class="d-flex align-items-center">
                                    <a href="{{ url('landing_page') }}">
                                        <img class="h-60px img-fluid" src="{{ asset('assets/images/logo_dkpp.jpeg') }}"/>
                                    </a>
                                    <h1 class="ms-3 nav-text"> {{ __('Dewan Kehormatan Penyelenggara Pemilu') }} </h1>
                                </div>
                                <!--end:Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Menu wrapper-->
                        <!--begin::Navbar-->
                        <div class="app-header-menu app-header-mobile-drawer align-items-stretch">
                            <div class="app-navbar flex-shrink-0">
                                    <div class="app-navbar-item ms-1 ms-lg-3">
                                        @if (Route::has('login'))
                                            @auth
                                                <a href="{{ route($route_get->route) }}" class="btn btn-lg btn-outline-primary fs-5">{{ __('DASHBOARD')}}</a>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary fs-5">Login</a>
                                                {{-- <a href="{{ route('register') }}" class="btn btn-sm btn-primary fs-5 mx-3">Register</a> --}}
                                            @endauth
                                        @endif
                                    </div>

                                <!--end::Header menu toggle-->
                            </div>
                        </div>
                        <!--end::Navbar-->
                    </div>
                    <!--end::Header wrapper-->
                </div>
                <!--end::Header container-->
            </div>
        </div>
    </div>
</body>
</html>

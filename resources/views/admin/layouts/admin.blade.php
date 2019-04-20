<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ (isset($module_name) ? ($module_name.' | ') : '') . config('app.name', 'Laravel') }}</title>

    @stack("meta-tags")

    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/css/app.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/css/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/css/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/fontawesome-free-5.0.13/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datepicker/datepicker3.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/summernote/summernote.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/switch/switchery.min.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dropzone/dropzone.css')}}" >
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/dropzone/basic.css')}}" >


    <!-- select 2 -->
    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.css') }}" rel="stylesheet"> -->
    <!-- Toastr style -->
    <link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css')}}">
    @if(isset($isIndexPage) && $isIndexPage)
        {{-- datatables --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/dataTables/modern/datatables.min.css') }}">

        {{-- sweetalert2 --}}
        <link href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    @endif

    <script>
        window.siteUrl="{{env('APP_URL')}}";
    </script>
    @stack("styles")
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    @include("admin.main.includes.topbar")

    @include("admin.main.includes.sidebar")

    <div class="app-content content" id="app">
        <div class="content-wrapper">

            @include("admin.main.includes.breadcrumb-and-button")

            <div class="content-body" >
                @yield('content')
            </div>
        </div>
    </div>

    {{-- @include("admin.main.includes.settings") --}}

    @include("admin.main.includes.footer")
    <script src="{{asset('admin-theme/vendors/js/vendors.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('admin-theme/js/core/app-menu.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-theme/js/core/app.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-theme/js/scripts/customizer.min.js')}}" type="text/javascript"></script>

    {{-- toastr --}}
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('plugins/switch/switchery.min.js') }}"></script>

    @include("admin.includes.custom")
    <script src="{{asset('js/app.js')}}" ></script>
    @if(isset($isIndexPage) && $isIndexPage)
        {{-- dataTables --}}
        <script src="{{ asset('plugins/dataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTables/Responsive-2.2.1/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/dataTables/Responsive-2.2.1/js/dataTables.responsive.min.js') }}"></script>

        {{-- Sweetalert2 --}}
        <script src="{{ asset('plugins/sweetalert2/es6-promise.auto.min.js') }} "></script> <!-- for IE support -->
        <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }} "></script>
    @endif

    @stack("scripts")
    <script>
        $(".dropdown-toggle").dropdown();
    </script>
</body>
</html>

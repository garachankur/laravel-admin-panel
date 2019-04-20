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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('plugins/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/css/app.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/css/vertical-menu-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/fonts/simple-line-icons/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-theme/css/colors/palette-gradient.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/fontawesome-free-5.0.13/css/fontawesome-all.min.css')}}">

    <!-- Toastr style -->
    <link href="{{ asset('plugins/toastr/toastr.min.css') }}" rel="stylesheet">

<style>
    .bg-lighten-2{
        background-color: #202153;
    }
</style>
    @stack("styles")
</head>
<body class="vertical-layout vertical-menu-modern 1-column bg-lighten-2 menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>


    <script src="{{asset('admin-theme/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-theme/js/core/app-menu.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin-theme/js/core/app.min.js')}}" type="text/javascript"></script>

    {{-- toastr --}}
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>

    @include("admin.includes.custom")

    @stack("scripts")
</body>
</html>

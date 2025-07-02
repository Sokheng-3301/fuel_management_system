<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{-- <title>IMS | KSIT</title> --}}
<!--begin::Primary Meta Tags-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="title" content="{{ env('APP_NAME') }}" />
<meta name="author" content="Hi Tech driking water" />

<meta name="description"
    content="Hi-Tech drinking water (Hi-Tech), Cambodia, Fuel Management System (FMS). ទឹកពិកសាហាយធិច (ហាយធិច), កម្ពុជា">
<meta name="keywords"
    content="Hi-Tech drinking water (Hi-Tech), Cambodia, Fuel Management System (FMS). ទឹកពិកសាហាយធិច (ហាយធិច), កម្ពុជា, Water, Technology">
<meta name="author" content="Voeurn Sokheng">

<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow" />
<meta name="google" content="translate" />
<meta name="revisit-after" content="1 days" />
<meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}" />
<meta name="theme-color" content="#ffffff" />
<meta name="apple-mobile-web-app-status-bar-style" content="default" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-title" content="{{ env('APP_NAME') }}" />
<meta name="msapplication-TileColor" content="#ffffff" />

<link rel="shortcut icon" href="{{ asset('dist/assets/img/FavIcon.png') }}" type="image/x-icon">
<!--end::Primary Meta Tags-->
<link rel="stylesheet" href="{{ asset('dist/css/index.css') }}"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="{{ asset('dist/css/overlayscrollbars.min.css') }}"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/icons.boostrap.min.css') }}"> --}}
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link rel="stylesheet" href="{{ asset('dist/css/apexcharts.css') }}"
        integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
    <!-- jsvectormap -->
    <link rel="stylesheet" href="{{ asset('dist/css/jsvectormap.min.css') }}"
        integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/semantic.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/dataTables.semanticui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/autoFill.semanticui.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap5.min.css') }}">


    <link rel="stylesheet" href="{{ asset('dist/css/jquery-ui.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/time-select/mdtimepicker.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/autoFill.bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/semantic.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/my.css.css') }}">

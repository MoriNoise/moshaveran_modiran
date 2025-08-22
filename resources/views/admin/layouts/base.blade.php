<!DOCTYPE html>

<html
    lang="fa"
    data-nav-layout="vertical"
    data-theme-mode="light"
    data-header-styles="light"
    data-menu-styles="light"
    dir="rtl"
    loader="enable"
    data-vertical-style="overlay">
<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        {{ config('project.admin_title') }}
        @isset($title)
            | {{ $title }}
        @endisset
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/admin/images/brand-logos/favicon.ico')}}" type="image/x-icon">

    <!-- Start::Styles -->

    <!-- Choices JS -->
    <script src="{{asset('assets/admin/js/choices.min.js')}}"></script>

    <!-- Main Theme Js -->
    <script src="{{asset('assets/admin/js/main.js')}}"></script>

    @include('admin.layouts.style')
</head>

<body class="@if(isset($authLayout) && $authLayout === true) authentication-background @endif">

<!-- Loader -->
<div id="loader" class="d-none">
    <img src="{{asset('assets/admin/images/media/loader.svg')}}" alt="">
</div>
<!-- Loader -->

<!-- page -->
<div class="page">
    @includeUnless((isset($rawLayout) && $rawLayout === true), 'admin.layouts.header')

    @includeUnless((isset($rawLayout) && $rawLayout === true), 'admin.layouts.sidebar')

    <!-- Start::app-content -->
    @yield('content')
    <!-- End::app-content -->

    @includeUnless((isset($rawLayout) && $rawLayout === true), 'admin.layouts.footer')

</div>
<!-- End Page -->

<!-- Scroll To Top -->
<div class="scrollToTop" style="display: none;">
    <span class="arrow lh-1"><i class="ri-rocket-line align-middle fs-18"></i></span>
</div>
<div id="responsive-overlay"></div>
<!-- Scroll To Top -->

@include('admin.layouts.script')

</body>
</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close" style="--primary-rgb: 88, 155, 255;">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="Description" content="قالب HTML داشبورد مدیریتی Meno" />
    <meta name="Author" content="قالب HTML داشبورد مدیریتی Meno" />
    <meta name="keywords" content="قالب HTML داشبورد مدیریتی Meno" />
    <title>@yield('title', 'خطا')</title>
    <link rel="icon" href="{{ asset('assets/admin/images/brand-logos/favicon.ico') }}" type="image/x-icon" />
    <link href="{{ asset('assets/libs/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/icons.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/admin/js/authentication-main.js') }}"></script>
</head>
<body>

<div class="page error-bg">
    <div class="error-page">
        <div class="container">
            <div class="my-auto">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-xl-8 col-lg-5 col-md-6 col-12 text-center">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>

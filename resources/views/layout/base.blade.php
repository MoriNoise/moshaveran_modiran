<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8"/>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/images/svg/vite.svg') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        {{ config('project.project_title') }}
        @isset($title)
            | {{ $title }}
        @endisset
    </title>
    <link rel="stylesheet" href="{{ asset('assets/styles/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/swiper/swiper.css') }}">

    <!-- ========================== DARK MODE SCRIPT ============================= -->
    <script type="text/javascript">
        if (
            localStorage.theme === "dark" ||
            (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    </script>
</head>

<body>

@include("layout.icons")

{{-- Only include header/footer if $noLayout is not true --}}
@unless (isset($noLayout) && $noLayout)
    @include('layout.header')
@endunless

@yield('content')

@unless (isset($noLayout) && $noLayout)
    <!-- Overlay -->
    <div class="overlay"></div>
    <div class="search-overlay"></div>
@endunless

@unless(isset($noLayout) && $noLayout || isset($noFooter) && $noFooter)
    @include('layout.footer')

@endunless

@include('layout.script')

</body>
</html>

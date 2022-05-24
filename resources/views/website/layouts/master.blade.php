<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page Title -->
    <title> @yield('pageTitle') | Học online - Vườn nghệ thuật dâu tây</title>

    <!-- Page header -->
    <meta charset="utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width"/>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('website_assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('website_assets/css/style.css'). '?v='. config('project.asset_version') }}"/>
    <link rel="stylesheet"
          href="{{ asset('website_assets/css/custom-style.css'). '?v='. config('project.asset_version') }}"/>
    <link rel="stylesheet"
          href="{{ asset('website_assets/css/padding-margin.css'). '?v='. config('project.asset_version') }}"/>
    <link rel="stylesheet" href="{{ asset('website_assets/css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('website_assets/images/logo2.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('website_assets/images/logo2.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('website_assets/images/logo2.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('website_assets/images/logo2.png') }}">

    @yield('css')
</head>
<body class="content-animate">

<!-- PRELOADER
==================================================-->
<div class="page-loader">
    <div class="loader-area"></div>
    <div class="loader font-face1"><img src="{{ asset('website_assets/images/logo2.png') }}" width="50" height="50" alt=""/></div>
</div>

<!-- PAGE
==================================================-->
<div id="top" class="page">
@include('website.layouts.header')

<!-- Main Content
    ==================================================-->
    <main class="cd-main-content">
        @yield('content')

        @include('website.layouts.footer')
    </main>

</div>

<!-- JAVASCRIPT
==================================================-->
<script src="{{ asset('website_assets/js/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('website_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('website_assets/js/waypoints.min.js') }}"></script>

<script src="{{ asset('website_assets/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.localScroll.min.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.viewport.mini.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.sticky.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.fitvids.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.parallax-1.1.3.js') }}"></script>
<script src="{{ asset('website_assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('website_assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('website_assets/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('website_assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('website_assets/js/slick.min.js') }}"></script>
<script src="{{ asset('website_assets/js/wow.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('website_assets/js/script.js'). '?v='. config('project.asset_version') }}"></script>

<!-- BACKEND CUSTOM JS
==================================================-->
<script src="{{ asset('website_assets/custom/js/custom.js'). '?v='. config('project.asset_version') }}"></script>
@yield('js')

</body>
</html>

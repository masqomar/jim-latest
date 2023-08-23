<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name', 'JIMPay') }}</title>
    <meta name="description" content="Kopkar JIM Mobile App">
    <meta name="keywords" content="kopkar jim, jimpay, koperasi karyawan jbi, kampung inggris, kampung inggris lc, kampung inggris pare" />
    <link rel="icon" type="image/png" href="{{ asset ('assets') }}/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset ('assets') }}/img/icon/192x192.png">
    <link rel="stylesheet" href="{{ asset ('assets') }}/css/style.css">
    <link rel="manifest" href="__manifest.json">
    @yield('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body style="background-color:#e9ecef;">
    <!-- App Capsule -->
    <div id="jimApp">
        @yield('content')
    </div>

    </div>



    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->

    </div>
    <!-- * App Capsule -->
    <!-- Jquery -->
    <script src="{{ asset ('assets') }}/js/lib/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap-->
    <script src="{{ asset ('assets') }}/js/lib/popper.min.js"></script>
    <script src="{{ asset ('assets') }}/js/lib/bootstrap.min.js"></script>
    <!-- Ionicons -->
    <script src="{{ asset ('assets') }}/js/lib/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset ('assets') }}/js/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset ('assets') }}/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
    <!-- Base Js File -->
    <script src="{{ asset ('assets') }}/js/base.js"></script>
</body>

</html>
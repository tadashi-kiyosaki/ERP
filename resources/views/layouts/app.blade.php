<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    @yield('title')

    <!-- Fontfaces CSS-->
    <link href="/theme/css/font-face.css" rel="stylesheet" media="all">
    <link href="/theme/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="/theme/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="/theme/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="/theme/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="/theme/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/theme/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="/theme/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="/theme/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="/theme/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="/theme/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/theme/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="/theme/css/theme.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="/intl-tel-input-master/build/css/intlTelInput.css">
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


</head>
<body>
    @guest
        @yield('loginContent')
    @else
        @include('layouts.sidebar')
        @include('layouts.header')
        @yield('content')
    @endguest

<!-- Jquery JS-->
<script src="/theme/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="/theme/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="/theme/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="/theme/vendor/slick/slick.min.js">
</script>
<script src="/theme/vendor/wow/wow.min.js"></script>
<script src="/theme/vendor/animsition/animsition.min.js"></script>
<script src="/theme/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="/theme/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="/theme/vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="/theme/vendor/circle-progress/circle-progress.min.js"></script>
<script src="/theme/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/theme/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="/theme/vendor/select2/select2.min.js"></script>
<!-- Main JS-->
<script src="/theme/js/main.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>

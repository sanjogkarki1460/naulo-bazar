<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="assets/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="assets/favicon.png" rel="icon">
    <meta name="author" content="Bikash Bhandari">
    <meta name="keywords" content="Online Shopping Nepal">
    <meta name="description" content="Online Shopping Nepal">
    <title>One Store :: Online Shopping in Nepal</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700&amp;amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/fonts/linearicons/font/demo-files/demo.css')}}">
    <link rel="stylesheet" href="{{asset('gh/dogfalo/materialize_master/extras/nouislider/nouislider.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/owl-carousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/lightgallery/dist/css/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="{{asset('assets/plugins/jquery-bar-rating/dist/jquery.barrating.min.js')}}" defer></script>
</head>

<body>
<div id="app">
    
    @include('front.partials.header')
        <main class="no-main ps-home--dark">
            <!-- home section -->
            @yield('content')
            <!-- home section end -->        
        </main>
        @include('front.partials.footer')
</div>

    <script src="{{asset('js/app.js')}}"></script>
    <!-- <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
    
    <script src="{{asset('assets/plugins/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/popper.min.js')}}" ></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery.matchheight-min.js')}}" ></script>
    <script src="{{asset('assets/plugins/select2/dist/js/select2.min.js')}}" ></script>
    <!-- <script src="{{asset('assets/plugins/slick/slick.js')}}"></script> -->
    <script src="{{asset('assets/plugins/lightgallery/dist/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('gh/dogfalo/materialize_master/extras/nouislider/nouislider.min.js')}}"></script>
    <!-- custom code-->
</body>

</html>
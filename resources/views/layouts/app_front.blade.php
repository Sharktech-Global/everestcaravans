<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="format-detection" content="telephone=no">{!! SEO::generate() !!}
    <title>Home</title>
    {{-- FAVICON --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5CWWHP5');</script>
    <!-- End Google Tag Manager -->
    {{-- end favicons --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/font-awesome.min.css')}}"> --}}
    <!-- <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.15.4/css/solid.css">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/slick.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/mmenu-light.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/owl.theme.default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/inttel/intlTelInput.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/common.css') }}">

    @yield('css_after')
    <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5CWWHP5"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
  
    <main class="main-yield">
        @yield('content')
    </main>
   


    <!-- Copyright end-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
    <!-- <script src="assets/js/jquery-3.2.1.slim.min.js')}}"></script> -->
    <script src="{{ asset('assets/front/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/slick-animation.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/mmenu-light.js') }}"></script>
    <script src="{{ asset('assets/front/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/inttel/intlTelInput.min.js') }}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/animated-header/0.0.1/js/cbpAnimatedHeader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/classie/1.0.1/classie.js"></script> --}}

    <script src="{{ asset('assets/front/js/style.js') }}"></script>
     {{-- /* include below script tags at the end of your html body */ --}}

        <script>
            (function (botId) {
            var s = document.createElement("script");
            s.async = true;
            s.type = 'text/javascript';
            s.src = "https://app.chat360.io/widget/chatbox/common_scripts/script.js";
            s.onload = function () {
                window.loadChat360Bot(botId);
            };
            s.onerror = function (err) {
                console.error(err);
            };
            document.body.appendChild(s);
            })("cd88cf7c-b5ca-45a2-bc3c-982642749bef");
        </script>

    <script>
        $(".phone").intlTelInput({
            formatOnDisplay: false,
            autoPlaceholder: "off",
            nationalMode: false,
            initialCountry: "auto",
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },
        });
        function loader_loading(){
            $('#loading-bar-spinner').css("display", "block");
        }



    </script>

    
    <script>
        var currentURL = window.location.href;
        var appBaseUrl = {!! json_encode(url('/')) !!}+'/';
        /*alert(currentURL);
        alert(appBaseUrl);*/
        if(currentURL != appBaseUrl){
            /*alert('test');*/
             $(document).ready(function() {
                $('header.header_area.navbar-fixed-top').addClass('cbp-af-header-shrink');
                $('header.header_area.navbar-fixed-top.cbp-af-header').addClass('cbp-af-header-shrink');
                var header = $(".header_area");
                $(window).scroll(function() {
                    var scroll = $(window).scrollTop();
                    if (scroll >= 1) {
                        header.addClass("cbp-af-header-shrink");
                    } else {
                        header.addClass("cbp-af-header-shrink");
                    }
                });
            });
        }
       
    </script>

    @yield('js_after')

</body>

</html>

<!DOCTYPE html>
<html lang="en" >

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <head>
  <base href="{{url('/')}}" target="_blank">
</head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->

    <?php
    if ($_SERVER['REMOTE_ADDR'] != '::1') { ?>
        <!-- Animate CSS -->
        <link rel="stylesheet" href="web/css/animate.min.css" />
    <?php }
    ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="web/css/bootstrap-rtl.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <!-- owl -->

    <link rel="stylesheet" href="web/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="web/css/owl.theme.default.min.css" />
    <!-- othres CSS -->
    <link rel="stylesheet" href="web/css/slick.css" />
    <link rel="stylesheet" href="web/css/magnific-popup.css" />
    <link rel="stylesheet" href="web/css/slick-theme.css" />
    <link rel="stylesheet" href="css/app.css" />

    <!-- custome css  -->
    <link rel="stylesheet" href="web/stylesheets/style2.css" />
    <link rel="stylesheet" href="web/stylesheets/style.css" />
    <script src="web/js/jquery-3.2.1.min.js"></script>
    
    <script src="web/js/owl.carousel.min.js"></script>

    <title>{{trans('home.hamid_store')}}</title>
    <style>
        #top_slider{
            direction: ltr;
        }
        @media screen and (min-width: 992px) {
        
.nd-menu .nav-item.dropdown, .nd-menu .nav-link{
       
    position: relative;
}

        }
    </style>
</head>


<body class=" px-0 @if(session('lang_id')!=2) rtl @endif ">

    @include('front.layout.sub.header')
    <div id="app">
        @yield('content')
    </div>
    @include('front.layout.sub.footer')

    <script src="web/js/jquery.min.js"></script>
    <script src="web/js/popper.min.js"></script>
    <script src="web/js/bootstrap.min.js"></script>

    <script src="web/js/parallax.js"></script>
    <script src="web/js/paraxify.js"></script>
    <script src="web/js/countdown.js"></script>
    <script src="web/js/scrollup.js"></script>
    <script src="web/js/images-loaded.js"></script>
    <script src="web/js/easyzoom.js"></script>
    {{-- <script src="web/js/sticky-sidebar.js"></script> --}}
    <!-- Main JS -->
    <script src="web/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        //var test=JSON.stringify();
        
        window.trans={!! $trans !!};
    </script>
    <script src="js/app.js?v={{time()}}"></script>
    @stack('script')
    <script>
        $(document).ready(function(){
            
        $('.container').children('.owl-nav').hide();
        });
        </script>
</body>

</html>
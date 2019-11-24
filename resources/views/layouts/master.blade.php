<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('libraries.font')
        @include('libraries.style')
        @include('libraries.javascript')
    </head>
    <body>
        
       <?php 
        if(!isset($_GET['login']))
            $login = false; 
        else
            $login = $_GET['login'];
            $UserPhotoProfile = "https://yt3.ggpht.com/-MhdomghHvC4/AAAAAAAAAAI/AAAAAAAAAAA/HPEwaJwVRQU/s88-c-k-no-mo-rj-c0xffffff/photo.jpg";
            $UserPhotoCover = "http://bancodeimagenesgratis.net/wp-content/uploads/2015/09/615-portadas-para-facebook.jpg";
            $UserPhotoProfileDefault = "img/profile.png";
            $UserName = "Esteban Carranza";
            $UserEmail = "esteban.carranza@outlook.com";
       ?>
    @include('inc.navbar')
    @include('inc.sidebar')
    
    @if(isset($showCarousel))
        @if($showCarousel)
            @include('inc.carousel')
        @endif
    @endif
    
    <section class="container md-padding row container-landingpage">
        @yield('content')
        @yield('pagination')
    </section>
    <div class="fixed-action-btn-up">
        <a class="ir-arriba btn-floating btn-large">
            <i class="large material-icons">arrow_upward</i>
        </a>
    </div>
    @include('inc.footer')

     <script>
            $(document).ready(function()
            {
                $('.ir-arriba').click(function(){
                    $('body, html').animate({
                        scrollTop: '0px'
                    }, 100);
                });
                    
                $(window).scroll(function(){
                    if( $(this).scrollTop() > 0 ){
                        $('.ir-arriba').slideDown(100);
                    } else {
                        $('.ir-arriba').slideUp(100);
                    }
                });
                
            });
        </script>
    </body>
</html>

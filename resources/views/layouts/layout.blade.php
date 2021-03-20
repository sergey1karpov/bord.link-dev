<!DOCTYPE html>
<html lang="ru">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>bord.link @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Your collection of microservices for social networks"/>
    <meta name="keywords" content="Your collection of microservices for social networks"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Open Graph tags-->
    <meta property="og:title" content="bord.link - Your collection of microservices for social networks" />
    <meta property="og:url" content="http://bord.link" />
    <meta property="og:site_name" content="bord.link" />
    <meta property="og:description" content="Your collection of microservices for social networks" />
    <meta property="og:image" content="{{$post->img_link ?? asset('img/logo4.png')}}"/>
    <meta property="og:type" content="website" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">

    <!-- Bootstrap and CSS-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/test.js') }}"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jaldi&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;500&display=swap" rel="stylesheet">

    <!-- $user->about & $user->site font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@00&display=swap" rel="stylesheet">

    {!! htmlScriptTagJsApi() !!}
</head>
<body>

<div class="container" style="padding: 0">
<!--Navbar -->
<nav class="navbar navbar-dark fixed-top" style="padding-left:8px; padding-right: 8px; background-color: #040404">
    <a class="navbar-brand" href="/"><img src="{{asset('img/logo.png')}}" class="img-fluid mb-1" width="120;"></a>
{{--    <a class="navbar-brand" href="/"><h1 style="font-family: 'Jost', sans-serif; font-size: 1em; margin-bottom: 0; color: #f4f4f2; text-transform: uppercase; ">bord.link</h1></a>--}}
{{--    <a class="navbar-brand" href="/" style="font-family: 'Archivo Black', sans-serif; font-size: 27px; color: #de4e44">bord.link</a>--}}
    <button style="border: none; background-color: #040404; outline: none; padding-right:0px" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
        <img src="{{asset('img/footer/menu2.png')}}" class="img-fluid ml-1 " width="20px" title="Menu" style="margin-bottom: 6px">
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-555">

        <ul class="navbar-nav ml-auto nav-flex-icons">
            @if(Auth::check())
                @if(Auth::user()->avatar)
                    <li class="nav-item avatar">
                        <a class="nav-link p-0" href="#">
                        {{-- <img src="{{Auth::user()->avatar}}" height="35px" width="35px"> --}}
                        <div class="img " style="background-image: url({{Auth::user()->avatar}});"></div>
                        </a>
                    </li>
                @endif
            @endif
            @guest
                    <li class="nav-item">
                        <a class="nav-link header-font" href="{{route('blog.index')}}" ><h1 style="font-family: 'Jost', sans-serif; font-size: 1.2em; margin-bottom: 0; color: #f4f4f2; text-transform: uppercase; ">блог</h1></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/contacts')}}" ><h1 style="font-family: 'Jost', sans-serif; font-size: 1.2em; margin-bottom: 0; color: #f4f4f2; text-transform: uppercase; ">контакты</h1></a>
                    </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('login') }}"><h1 style="font-family: 'Jost', sans-serif; font-size: 1.2em; margin-bottom: 0; color: #f4d3b0; text-transform: uppercase; ">логин</h1></a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}"><h1 style="font-family: 'Jost', sans-serif; font-size: 1.2em; margin-bottom: 0; color: #f4d3b0; text-transform: uppercase; ">регистрация</h1></a>
            </li>
            @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown"  class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item nav-item"  href="{{route('profile', Auth::user()->nickname)}}">
                            {{ __('Profile') }}
                        </a>
                        @if(\Auth::user()->role_id != 1)
                        <a class="dropdown-item nav-item"  href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        @else
                        <a class="dropdown-item nav-item"  href="{{ route('home', ['id' => Auth::user()->id]) }}">
                            {{ __('Home') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                        </a>
                        @endif
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<!--/.Navbar -->
</div>

<div class="container-fluid main-container">
    @yield('content')
</div>
{{--<div class="container-fluid" style="background-color: #bad5dc ">--}}
<div class="container-fluid" >
    @yield('content2')
</div>
<div class="container-fluid" >
    @yield('content3')
</div>
<div class="container-fluid" >
    @yield('content4')
</div>
<div class="container-fluid" >
    @yield('content5')
</div>
{{--<div class="container-fluid main-container d-xl-block d-none" style="background-color: #d0d0b8 ">--}}
{{--    @yield('content3')--}}
{{--</div>--}}
{{--<div class="container-fluid main-container d-xl-block d-none" style="background-color: #40817a ">--}}
{{--    @yield('content4')--}}
{{--</div>--}}
{{--<div class="container-fluid main-container d-xl-block d-none" style="background-color: #afbaa3 ">--}}
{{--    @yield('content5')--}}
{{--</div>--}}



{{--<div class="container">--}}
{{--<!-- Footer -->--}}
{{--<footer class="container py-5">--}}
{{--    <div class="row">--}}
{{--        <div class="col-12 col-md twxt-left">--}}
{{--        <small class="d-block mb-3 text-muted">&copy; 2020 bord.link</small>--}}
{{--            <!-- uSocial -->--}}
{{--            <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>--}}
{{--            <div class="uSocial-Share" data-pid="08162c357c37bd69da6f9509315d408b" data-type="share" data-options="round-rect,style3,default,absolute,horizontal,size32,eachCounter0,counter0,upArrow-right,nomobile" data-social="vk,twi,fb,telegram"></div>--}}
{{--            <!-- /uSocial -->--}}
{{--    </div>--}}
{{--    <div class="col-6 col-md">--}}
{{--      <h5>Information</h5>--}}
{{--        <ul class="list-unstyled text-small">--}}
{{--            <li><a class="text-muted" href="{{route('about')}}">What do we offer</a></li>--}}
{{--            <li><a class="text-muted" href="{{route('rules')}}">Rules</a></li>--}}
{{--            <li><a class="text-muted" href="{{url('/contacts')}}">Contacts</a></li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    <div class="col-6 col-md">--}}
{{--        <h5>Our projects</h5>--}}
{{--        <ul class="list-unstyled text-small">--}}
{{--            <li><a class="text-muted" href="#">BORD!MAG.</a></li>--}}
{{--            <li><a class="text-muted" href="#">App</a></li>--}}
{{--            <li><a class="text-muted" href="#">Podcast</a></li>--}}

{{--        </ul>--}}
{{--    </div>--}}
{{--    <div class="col-6 col-md">--}}
{{--        <h5>Join us</h5>--}}
{{--        <ul class="list-unstyled text-small">--}}
{{--            <li><a class="text-muted" href="#">Vkontakte</a></li>--}}
{{--            <li><a class="text-muted" href="#">Instagram</a></li>--}}
{{--            <li><a class="text-muted" href="#">Facebook</a></li>--}}
{{--            <li><a class="text-muted" href="#">Twitter</a></li>--}}

{{--        </ul>--}}
{{--    </div>--}}
{{--    <div class="col-6 col-md">--}}
{{--        <h5>Account</h5>--}}
{{--            <ul class="list-unstyled text-small">--}}
{{--                <li><a class="text-muted" href="#">Login</a></li>--}}
{{--                <li><a class="text-muted" href="#">Registration</a></li>--}}

{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}
{{--<!-- Footer -->--}}
{{--</div>--}}

</body>
</html>

<script type="text/javascript">
    $(document).ready(function(){

  $('.input').focus(function(){
    $(this).parent().find(".label-txt").addClass('label-active');
  });

  $(".input").focusout(function(){
    if ($(this).val() == '') {
      $(this).parent().find(".label-txt").removeClass('label-active');
    };
  });

});
</script>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$post->title ?? $user->name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Your collection of microservices for social networks"/>
    <meta name="keywords" content="Your collection of microservices for social networks"/>

    <!-- Open Graph tags-->
    <meta property="og:title" content="{{$post->title ?? 'Your collection of microservices for social networks'}}" />
    <meta property="og:url" content="http://www.bord.link" />
    <meta property="og:site_name" content="bord.link" />
    <meta property="og:description" content="Your collection of microservices for social networks" />
    <meta property="og:image" content="{{$post->img_link ?? asset('img/logo4.png')}}"/>
    <meta property="og:type" content="website" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/9bd26323f9.js" crossorigin="anonymous"></script>

    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">

    <!-- Bootstrap and CSS-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jaldi&display=swap" rel="stylesheet">

    <script src="{{asset('js/clipboard.min.js')}}"></script>

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

    <style>
        .delButton {
            background: url({{asset('img/footer/del.png')}}) 50% 50% no-repeat;
            background-size: contain;
            border: none;
            width: 40px;
            height: 20px;
        }
        .editButton {
            background: url({{asset('img/footer/edit.png')}}) 50% 50% no-repeat;
            background-size: contain;
            border: none;
            width: 40px;
            height: 20px;
        }
    </style>

</head>
<body>

{{--<div class="media-heading fixed-top d-lg-none" style="background-color: rgba(255,255,255,0.9)">--}}
{{--    <img src="{{asset('img/footer/menu.png')}}" class="img-fluid float-right  margins" width="30" data-toggle="modal" data-target="#mobileNav">--}}
{{--    --}}{{--    <small class="float-right  margins" style="margin-top: 5px"></small>--}}
{{--    <a href="{{route('profile', ['id' => $user->nickname])}}" style="color: black; text-decoration: none">--}}
{{--        <h5 class="margins mt-1" style="margin-bottom: 0">{{$user->name}}--}}
{{--            @if($user->verify)--}}
{{--                <img src="{{asset('img/verify.png')}}" class="img-fluid ml-1 mb-1" width="15px" title="Он настоящий!">--}}
{{--            @endif--}}
{{--        </h5>--}}
{{--    </a>--}}
{{--</div>--}}

<div class="ttt modal fade" id="mobileNav" tabindex="-1" role="dialog" aria-labelledby="mobileNav" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h6 style="font-family: 'Roboto', sans-serif; font-size: 0.9rem; margin-bottom: 5px">Генерировать короткую ссылку</h6>
                <form action="{{route('generateShortLink')}}" method="POST" id="generateShortLinkForm">
                    @csrf
                    <input type="hidden" name="old_link" value="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}">
                    <button class="btn btn-dark btn-sm" type="submit" id="generateShortLink">push</button>
                </form>
                <h6 id="showNewLink" class="mt-3"></h6>

                <button class="btn-clipboard btn btn-outline-dark btn-sm mb-2" data-clipboard-target="#showNewLink" style="display: none">
                    copy
                </button>

                <br>
                <h6 style="font-family: 'Roboto', sans-serif; font-size: 0.9rem; margin-bottom: 2px" >Поделиться с друзьями</h6>
                <!-- uSocial -->
                <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                <div class="uSocial-Share" data-pid="4de7c49aa36779d3776b505ae3bf22cd" data-type="share" data-options="round-rect,style3,default,absolute,horizontal,size32,eachCounter1,counter0,nomobile" data-social="vk,twi,fb,telegram"></div>
                <!-- /uSocial -->
                <br>


            </div>
        </div>
    </div>
</div>

<!--Navbar -->
<div class="col-12 menu left-column fixed-top sticky-top" id="menu">
    <div class="navbar navbar-dark" style="padding-left:8px; padding-right: 8px; background-color: #040404">
        <a style="text-decoration: none" href="{{route('profile', $user->nickname)}}">
            <h1 class="display-4" style="font-family: 'Jost', sans-serif; font-size: 1.2em; margin-bottom: 0; color: #f4f4f2; text-transform: uppercase; "><b>{{$user->name}}</b>
                @if($user->verify)
                    <img src="{{asset('img/verify2.png')}}" class="img-fluid ml-1" width="16px" title="Verified Page" style="margin-bottom: 4px">
                @endif
            </h1>
        </a>
        <button style="border: none; background-color: #040404; outline: none; padding-right:0px" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="{{asset('img/footer/menu2.png')}}" class="img-fluid ml-1 " width="20px" title="Menu" style="margin-bottom: 6px">
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item mb-1 mt-1">
                    <div class="card" style="margin-bottom: 0px; background-color: #040404">
                        <div class="card-body" style="padding:0; margin-top:10px">
                            <div class="media">
                                <div>
                                    <div class="img" style="background-image: url({{$user->avatar ?? asset('img/avatar.png')}});"></div>
                                </div>
                                <div class="media-body d-none d-xl-block ml-3">

                                </div>
                                <div class="media-body d-lg-none ml-1 mr-1">
                                    <h1 style="font-family: 'Raleway', sans-serif;font-size: 1em; color: #f7f6f0;">{{$user->about}}</h1>
                                    <h1 style="font-family: 'Raleway', sans-serif;font-size: 1em; color: #f7f6f0;"><a style="color:#f4d3b0;" href="http://{{$user->site}}">{{$user->site}}</a></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @guest
                    <li class="nav-item mt-3">
                        <a style="font-family: 'Jost', sans-serif; font-size: 1.2em; color: #f4d3b0; text-transform: uppercase; padding:0" class="nav-link" href="{{ route('login') }}">{{ __('Вход') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item mt-3">
                            <a style="font-family: 'Jost', sans-serif; font-size: 1.2em; color: #f4d3b0; text-transform: uppercase; padding:0" class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown mt-3">
                        <a style="font-family: 'Jost', sans-serif; font-size: 1.2em; color: #f7f6f0; text-transform: uppercase; padding:0" id="navbarDropdown"  class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color:#040404">
                            <a style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0" class="dropdown-item nav-item"  href="{{route('profile', Auth::user()->nickname)}}">
                                {{ __('Моя страница') }}
                            </a>
                            @if(\Auth::user()->role_id != 1)
                                <h1 class="mt-1" style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('editProfile', ['id' => Auth::user()->id])}}">Редактировать профиль</a></h1>
                                <h1 style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('allVideo', ['id' => Auth::user()->id])}}">Мои видеозаписи</a></h1>
                                <h1 style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('allAlbums', ['id' => Auth::user()->id])}}">Мои релизы</a></h1>
                                <h1 style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('events', ['id' => Auth::user()->id])}}">Мои мероприятия</a></h1>
                                <h1 class="text-muted" style="font-family: 'Jost', sans-serif; font-size: 0.9em; text-transform: uppercase; padding:0">
                                    <a style="color:#f7f6f0" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Выход') }}
                                    </a>
                                </h1>
                            @else
                                <h1 class="mt-1" style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('editProfile', ['id' => Auth::user()->id])}}">Редактировать профиль</a></h1>
                                <h1 style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('allVideo', ['id' => $user->id])}}">Мои видеозаписи</a></h1>
                                <h1 style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('allAlbums', ['id' => $user->id])}}">Мои релизы</a></h1>
                                <h1 style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('events', ['id' => $user->id])}}">Мои мероприятия</a></h1>

                                <h1 class="text-muted" style="font-family: 'Jost', sans-serif; font-size: 0.9em; text-transform: uppercase; padding:0">
                                    <a style="font-family: 'Jost', sans-serif; font-size: 1.2em; color: #f7f6f0; text-transform: uppercase; padding:0" class="dropdown-item nav-item"  href="{{ route('home', ['id' => Auth::user()->id]) }}">
                                        {{ __('Админка') }}
                                    </a>
                                </h1>
                                <h1 class="text-muted" style="font-family: 'Jost', sans-serif; font-size: 0.9em; text-transform: uppercase; padding:0">
                                    <a style="color:#f7f6f0" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Выход') }}
                                    </a>
                                </h1>
                            @endif
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</div>
{{--<div class="container-fluid d-none d-xl-block">--}}
{{--    <nav class="navbar navbar-expand-lg navbar-light bg-light ">--}}
{{--        <a class="navbar-brand" href="/"><img src="{{asset('img/logo.png')}}" class="img-fluid mb-1" width="120px;"></a>--}}
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555" aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarSupportedContent-555">--}}
{{--            <ul class="navbar-nav ml-auto nav-flex-icons">--}}
{{--                @if(Auth::check())--}}
{{--                    @if(Auth::user()->avatar)--}}
{{--                        <li class="nav-item avatar">--}}
{{--                            <a class="nav-link p-0" href="#">--}}
{{--                                --}}{{-- <img src="{{Auth::user()->avatar}}" height="35px" width="35px"> --}}
{{--                                <div class="img_avatar " style="background-image: url({{Auth::user()->avatar}});"></div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                @endif--}}
{{--                @guest--}}
{{--                    <li class="nav-item">--}}
{{--                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link header-font" href="{{route('blog.index')}}" >Blog</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link" href="{{url('/contacts')}}" >Contacts</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item ">--}}
{{--                        <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                    </li>--}}
{{--                    @if (Route::has('register'))--}}
{{--                        <li class="nav-item">--}}
{{--                            <a style="font-family: 'Jaldi', sans-serif; font-size: 1.2rem; color: #343434; " class="nav-link" href="{{ route('register') }}">{{ __('Registration') }}</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                @else--}}
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a id="navbarDropdown"  class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                            {{ Auth::user()->name }} <span class="caret"></span>--}}
{{--                        </a>--}}

{{--                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                            <a class="dropdown-item nav-item"  href="{{route('profile', ['id' => Auth::user()->nickname])}}">--}}
{{--                                {{ __('Profile') }}--}}
{{--                            </a>--}}
{{--                            @if(\Auth::user()->role_id != 1)--}}
{{--                                <a class="dropdown-item nav-item"  href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                            document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}
{{--                            @else--}}
{{--                                <a class="dropdown-item nav-item"  href="{{ route('home', ['id'=>Auth::user()->id]) }}">--}}
{{--                                    {{ __('Home') }}--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                                document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}
{{--                            @endif--}}
{{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
{{--                                @csrf--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endguest--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </nav>--}}
{{--</div>--}}
<!-- EndNavbar -->

<div class="container d-none d-xl-block">
    <div class="row">
        <div class="col-12">
            @if($post->img)
                <div class="text-center" style="padding-left: 16px; padding-right: 16px">
                    <img src="{{$post->img}}" class="img-fluid mb-2" width="100%">
                </div>
            @endif
            @if($post->title)
                    <h5 style="white-space: pre-wrap; padding-left: 16px; padding-right: 16px"><b>{{$post->title}}</b></h5>
            @endif
            @if($post->message)
                <div class="text-muted text-small margins" style="white-space: pre-wrap; padding-left: 16px; padding-right: 16px">{!!$post->message!!}</div>
            @endif
            <br>
                @if($post->videoPost)
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe style="padding-left: 16px; padding-right: 16px" class="embed-responsive-item" src="{{$post->videoPost}}" allowfullscreen></iframe>
                    </div>
                @endif
{{--                @if(Auth::check())<form action="{{route('likePost', ['id' => Auth::user()->id, 'postId' => $post->id])}}" method="POST">@endif--}}
{{--                    @csrf @method('PATCH')--}}
{{--                    --}}{{--    <input type="submit" value="{{$post->likepost}}" id="likepostbtn{{$post->id}}" name="likepostbtn">--}}
{{--                    @if(Auth::check())<button type="submit" class="button-delete-post" style="padding-left: 16px"><img src="{{asset('img/footer/like.png')}}" class="img-fluid" width="25"><small class="text-muted mr-4" style="font-size: 13px">{{$post->likepost}}</small></button>@endif--}}
{{--                    @if(Auth::guest())<img src="{{asset('img/footer/like.png')}}" class="img-fluid" width="40" style="padding-left: 16px"><small class="text-muted" style="font-size: 13px">{{$post->likepost}}</small>@endif--}}
{{--                </form>--}}
                @if($post->post_images)
                    @foreach(unserialize($post->post_images) as $img)
                        <img src="{{$img}}" class="img-fluid mt-1">
                    @endforeach
                @endif
        </div>
    </div>
</div>



<div class="media d-lg-none" >
    <div class="img-post d-none d-xl-block"></div>
    <div class="media-body">
        @if($post->img)
            <div>
                <img src="{{$post->img}}" class="img-fluid">
            </div>
        @endif
        <br>
        @if($post->title)
            <div class="ml-1 mr-1 mb-3">
                <h5 style="color: #14110f; font-family: 'Jost', sans-serif; font-size: 1.8em; line-height: 1; color: #14110f; text-transform: uppercase"><b>{{$post->title}}</b></h5>
            </div>
        @endif
        @if($post->slug)
                <div class="text-muted text-small margins "><h1 style="white-space: pre-wrap; font-family: 'Lora', serif; font-weight: 300; font-size: 1.5em; line-height: 1.1; color: #14110f">{!!$post->slug!!}</h1></div>
        @endif
        @if($post->message)
                <div class="text-muted text-small margins mt-3"><h1 style="white-space: pre-wrap; font-family: 'Lora', serif; font-weight: 300; font-size: 1.2em; line-height: 1.3; color: #14110f">{!!$post->message!!}</h1></div>
        @endif
            @if($post->videoPost)
                <div class="embed-responsive embed-responsive-16by9 mt-4">
                    <iframe class="embed-responsive-item" src="{{$post->videoPost}}" allowfullscreen></iframe>
                </div>
            @endif
    </div>
</div>
{{--+++++++++++++++++++++++++++++++++--}}

<div class="media d-lg-none mt-1" >
    <div class="media-body">
        @if($post->post_images)
            @foreach(unserialize($post->post_images) as $img)
                <img src="{{$img}}" class="img-fluid mt-1">
            @endforeach
        @endif
    </div>
</div>
{{--+++++++++++++++++++++++++++++++++--}}
<div class="media d-lg-none" style="margin-top: 30px">
{{--    @if(Auth::check())<form action="{{route('likePost', ['id' => Auth::user()->id, 'postId' => $post->id])}}" method="POST">@endif--}}
{{--        @csrf @method('PATCH')--}}
{{--        @if(Auth::check())<button type="submit" class="button-delete-post ml-1" style="padding: 0"><img src="{{asset('img/footer/like.png')}}" class="img-fluid" width="25"><small class="text-muted mr-4" style="font-size: 13px">{{$post->likepost}}</small></button>@endif--}}
{{--        @if(Auth::guest())<img src="{{asset('img/footer/like.png')}}" class="img-fluid ml-1" width="25"><small class="text-muted mr-4" style="font-size: 13px">{{$post->likepost}}</small>@endif--}}
{{--    </form>--}}

{{--    <h6 class="text-muted text-right" style="margin-top: 3px">Posted {{$post->created_at->diffForHumans()}}</h6>--}}
</div>
<div class="row " style="margin: 0">
    <div class="col-4" style="padding: 4px">
        @if(Auth::check())<form id="likeForm{{$post->id}}" action="{{route('likePost', ['id' => Auth::user()->id, 'postId' => $post->id])}}" method="POST">@endif
            @csrf @method('PATCH')
            @if(Auth::check())<button id="likeBtn{{$post->id}}" type="button" class="button-delete-post ml-1" style="padding: 0; outline: none; background-color:#e8e8e8"><img src="{{asset('img/footer/like.png')}}" class="img-fluid" width="17" style="margin-bottom: 3px"><small id="likeCount" class="text-muted ml-2 mr-4" style="font-size: 17px; font-family: 'Raleway', sans-serif">{{$post->likepost}}</small></button>@endif
            @if(Auth::guest())<img src="{{asset('img/footer/like.png')}}" class="img-fluid ml-1" width="17"><small id="likeCount" class="text-muted ml-2 mr-4" style="font-size: 17px; font-family: 'Raleway', sans-serif">{{$post->likepost}}</small>@endif
        </form>
    </div>
    <div class="col-8" style="padding: 4px">
        <h6 class="text-muted text-right" style="margin-top: 4px; font-family: 'Raleway', sans-serif">Опубликовано {{$post->created_at->diffForHumans()}}</h6>
    </div>
</div>

<hr>

<div class="container" style="padding: 0">
    <!-- Add Comment -->
    @if(Auth::check())
        <div class="container allalbums mb-5 text-center mt-3" style="margin-bottom: 70px">
            <div class="col-12 " style="padding: 5px">
                <form action="{{route('sendComment', ['id' => Auth::user()->id, 'postId' => $post->id])}}" method="post" id="addCommentForm">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                    </div>
                    <input type="hidden" value="{{$post->id}}" name="postId">
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-sm btn-dark">Комментировать</button>
                    </div>
                </form>
            </div>
        </div>
@endif

<!-- Show Comment -->
    <div id="commentPost">
        @foreach($post->comments as $comment)
            <div class="container allalbums mt-3 commentPost"  id="commentPost{{$comment->id}}" data-id="{{$comment->id}}">
                <div class="col-12" style="padding: 0">
                    <div class="card-body" style="padding: 0">
                        <div class="row" style="margin: 0">
                            <div class="col-2" style="padding-right: 5px; padding-left: 5px">
                                <div class="img_avatar" style="background-image: url({{$comment->user_avatar}});"></div>
                            </div>
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <a class="float-left" href="{{route('profile', ['nickname' => $comment->user_name])}}"><h1 style="margin:0; font-size:1.1em; font-family: 'Jost', sans-serif;">{{$comment->user_name }}</h1></a>
                                        </div>
                                        <div class="row">
                                            <small class="text-muted">{{$comment->created_at->diffForHumans()}}</small>
                                        </div>

                                    </div>
                                    @if(Auth::check())
                                        @if(Auth::user()->id == $comment->user_id)
                                            <div class="col-6 text-right">
                                                <form action="{{route('deleteComment', ['id' => $user->id, 'postId' => $post->id, 'commentId' => $comment->id])}}" method="post" id="deleteComForm{{$comment->id}}">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn mr-1 delButton" id="deleteComment{{$comment->id}}" data-id="{{$comment->id}}"></button>
                                                    <button type="button" class="btn mr-1 editButton" id="editButton{{$comment->id}}"></button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
{{--                                    @if(Auth::check())--}}
{{--                                        @if(Auth::user()->id != $comment->user_id)--}}
{{--                                            <div class="col-6 text-right">--}}
{{--                                                <h6>Ответить</h6>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                    @endif--}}
                                </div>
{{--                                <div class="clearfix"></div>--}}
                                <div class="row mt-2" style="padding: 0; font-family: 'Raleway', sans-serif">{{$comment->comment}}</div>
                                <div style="display: none" id="editComForm{{$comment->id}}">
                                    <form action="{{route('editComment', ['id' => $user->id, 'postId' => $post->id, 'commentId' => $comment->id])}}" method="POST" id="editComFormData{{$comment->id}}">
                                        @csrf @method('PATCH')
                                        <textarea class="form-control" name="commentEdited" rows="3">{{$comment->comment}}</textarea>
                                        <button type="submit" class="btn editButton" id="editComBtn{{$comment->id}}"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr width="75%">
        @endforeach
    </div>
</div>

<!-- Modal Edit Post-->
<div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="editPost" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактировать запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('editPost', ['id' => $user->id, 'postId' => $post->id])}}" method="post" enctype="multipart/form-data" id="form">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <textarea name="title" class="form-control" rows="1">{{$post->title}}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea id="editTitle" maxlength="200" name="slug" class="form-control" rows="5">{{$post->slug}}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-control" rows="10">{!!$post->message!!}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea maxlength="100" class="form-control mt-1" id="videoPost" name="videoPost" cols="100" rows="1">{{$post->videoPost}}</textarea>
                    </div>
                    <h6>Текущее изображение</h6>
                    <img src="{{$post->img}}" class="img-fluid mb-2" width="150">
                    <div class="form-group">

                        <input type="file" id="img" name="img" value="Прикрепить изображение" >
                    </div>
                    <h6>Дополнительные изображения</h6>
                                                        <div>
                                                            @if($post->post_images)
                                                                @foreach(unserialize($post->post_images) as $img)
                                                                    <img src="{{$img}}" class="img-fluid mb-2" width="100">
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="form-group" >
                                                            <input type="file" id="imgs" name="imgs[]" class="mt-2" accept="image/*" multiple>
                                                        </div>
                    <button type="submit" class="btn btn-sm btn-primary">Редактировать</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<!-- Mobile Footer social -->
@if(Auth::check())
    <div class="container ">
        <div class="row ">
            <div class="col-lg-12 ">
                <nav class=" fixed-bottom " style="background-color: #040404">
                    <div class="row">
                        <div class="col-12 ">
                            @if($user->id == Auth::user()->id)
                                <div class="row text-center">
                                    <div class="col-6">
                                        <h6 style="margin-top:2px; font-family: 'Jost', sans-serif; font-size: 1em; margin-bottom: 0; color: #f4f4f2; text-transform: uppercase; " data-toggle="modal" data-target="#mobileNav">поделиться</h6>
                                    </div>
                                    <div class="col-6">
                                        <h6 style="margin-top:2px; font-family: 'Jost', sans-serif; font-size: 1em; margin-bottom: 0; color: #f4f4f2; text-transform: uppercase; " data-toggle="modal" data-target="#editPost">изменить</h6>
                                    </div>
                                </div>
                            @endif
                            @if($user->id != Auth::user()->id)
                                <div class="row text-center">
                                    <div class="col-12">
                                        <h6 style="margin-top:2px; font-family: 'Jost', sans-serif; font-size: 1em; margin-bottom: 0; color: #f4f4f2; text-transform: uppercase; " data-toggle="modal" data-target="#mobileNav">поделиться</h6>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endif
@if(Auth::guest())
    <div class="container ">
        <div class="row ">
            <div class="col-lg-12 ">
                <nav class=" fixed-bottom " style="background-color: #040404">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="row text-center">
                                <div class="col-12">
                                    <h6 style="margin-top:2px; font-family: 'Jost', sans-serif; font-size: 1em; margin-bottom: 0; color: #f4f4f2; text-transform: uppercase; " data-toggle="modal" data-target="#mobileNav">поделиться</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endif
{{--<div class="container ">--}}
{{--    <div class="row ">--}}
{{--        <div class="col-lg-12 ">--}}
{{--            <nav class=" fixed-bottom " style="background-color: #e4e4e4">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12 " >--}}
{{--                        <div class="row">--}}
{{--                            <div class="col text-center" style="padding: 0">--}}
{{--                                <img src="{{asset('img/footer/main.png')}}" class="img-fluid" width="30" data-toggle="modal" data-target="#mobileNav">--}}
{{--                            </div>--}}
{{--                            @if($user->vk)--}}
{{--                            <div class="col text-center" style="padding: 0">--}}
{{--                                <a href="{{$user->vk}}"><img src="{{asset('img/footer/vk.png')}}" class="img-fluid " width="30"></a>--}}
{{--                            </div>--}}
{{--                            @endif--}}
{{--                            @if($user->facebook)--}}
{{--                            <div class="col text-center" style="padding: 0">--}}
{{--                                <a href="{{$user->facebook}}"><img src="{{asset('img/footer/fb.png')}}" class="img-fluid  " width="30"></a>--}}
{{--                            </div>--}}
{{--                            @endif--}}
{{--                            @if($user->twitter)--}}
{{--                            <div class="col text-center" style="padding: 0">--}}
{{--                                <a href="{{$user->twitter}}"><img src="{{asset('img/footer/tw.png')}}" class="img-fluid " width="30"></a>--}}
{{--                            </div>--}}
{{--                            @endif--}}
{{--                            @if($user->insta)--}}
{{--                            <div class="col text-center" style="padding: 0">--}}
{{--                                <a href="{{$user->insta}}"><img src="{{asset('img/footer/in.png')}}" class="img-fluid  " width="30"></a>--}}
{{--                            </div>--}}
{{--                            @endif--}}
{{--                            <div class="col text-center" style="padding: 0">--}}
{{--                            @if(Auth::check())--}}
{{--                                @if(Auth::user()->id == $user->id)--}}
{{--                                    <!-- Button trigger modal -->--}}
{{--                                        <img src="{{asset('img/footer/edit.png')}}" class="img-fluid" width="30" data-toggle="modal" data-target="#editPost">--}}
{{--                                    @endif--}}
{{--                                @endif--}}
{{--                                @if(Auth::check())--}}
{{--                                    @if(Auth::user()->id != $user->id)--}}
{{--                                        <a href="{{route('profile', ['id' => Auth::user()->nickname])}}"><img class="img-footer " style="background-image: url({{Auth::user()->avatar}});"></a>--}}
{{--                                    @endif--}}
{{--                                @endif--}}
{{--                                @if(Auth::guest())--}}
{{--                                    <a href="{{route('login')}}"><img src="{{asset('img/footer/login.png')}}" class="img-fluid " width="30"></a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </nav>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- End Footer social -->

</body>
</html>

<script type="text/javascript">
    var clipboard = new ClipboardJS('.btn');

    clipboard.on('success', function(e) {
        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        e.clearSelection();
    });

    clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
    });
</script>

<script>
    // Account link
    $("#copyPostLink").click(function() {
        $("#showCopyPostLink").show();
    });
</script>

<!-- Ajax add post-->
@if(Auth::check())
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#addCommentForm").submit(function(e) {
        e.preventDefault();

        var formData = $("#addCommentForm").serialize();

        $.ajax({
            url: "{{route('sendComment', ['id' => Auth::user()->id, 'postId' => $post->id])}}",
            type: "POST",
            data:formData,
            success: function (data) {
                // console.log(data);
                $("#commentPost").html($(data).find("#commentPost").html());
                $('#comment').val('').change();
            }
        });
    });
</script>
@endif

@if(Auth::check())
@foreach($post->comments as $comment)
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $("body").on("click","#deleteComment{{$comment->id}}",function(e){
            e.preventDefault();

            var id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "{{route('deleteComment', ['id' => $user->id, 'postId' => $post->id, 'commentId' => $comment->id])}}",
                type: "DELETE",
                data: {_token: token, id: id},
                success: function() {
                    $("#commentPost{{$comment->id}}").remove();
                },
            });
        });
    });
</script>
@endforeach
@endif


@if(Auth::check())
    @foreach($post->comments as $comment)
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Open form
            $("#editButton{{$comment->id}}").click(function() {
                $("#editComForm{{$comment->id}}").show();
            });

            // Ajax edit script
            $("#editComBtn{{$comment->id}}").click(function(e) {
                e.preventDefault();

                var editComFormData = $("#editComFormData{{$comment->id}}").serialize();

                $.ajax({
                    url: "{{route('editComment', ['id' => $user->id, 'postId' => $post->id, 'commentId' => $comment->id])}}",
                    type: "POST",
                    data: editComFormData,
                    success: function(data) {
                        $("#commentPost{{$comment->id}}").html($(data).find("#commentPost{{$comment->id}}").html());
                        $("#editComForm{{$comment->id}}").hide();
                    }
                });
            });

        </script>
    @endforeach
@endif

@if(Auth::check())
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#likeBtn{{$post->id}}").click(function() {

            var data = $("#likeForm{{$post->id}}").serialize();

            $.ajax({
                url: "{{route('likePost', ['id' => Auth::user()->id, 'postId' => $post->id])}}",
                type: "PATCH",
                data: data,

                success: function(data) {
                    {{--$("#likeForm{{$post->id}}").html($(data).find("#likeForm{{$post->id}}").html(data));--}}
                    $("#likeCount").html(data);
                },
                error: function() {
                    console.log('errrr');
                },
            });

        });
    </script>
@endif



<script type="text/javascript">
   $("#generateShortLink").click(function(e) {
       e.preventDefault();

       var form = $('#generateShortLinkForm').serialize();

       $.ajax({
           url: "{{route('generateShortLink')}}",
           type: "POST",
           data: form,
           success: function(data) {
               $("#showNewLink").html(data);
           },
           error: function() {
               alert('errorroror');
           },

       });

   });
</script>

<!-- Copy short link and show copy btn -->


<script type="text/javascript">
    $("#generateShortLink").click(function() {
        $(".btn-clipboard").show();
    })
</script>
<!--  -->

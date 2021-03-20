<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$user->name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{$user->about}}"/>
    <meta name="keywords" content="Your collection of microservices for social networks"/>

    <!-- Open Graph tags-->
    <meta property="og:title" content="{{$user->name}}" />
    <meta property="og:url" content="http://www.bord.link" />
    <meta property="og:site_name" content="bord.link" />
    <meta property="og:description" content="{{$user->about}}" />
    <meta property="og:image" content="{{$user->avatar}}"/>
    <meta property="og:type" content="website" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.js"></script>

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

    <!-- $user->message font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ledger&display=swap" rel="stylesheet">

</head>
<body class="mb-5">


<div class="modal fade" id="addPostModalBtn" tabindex="-1" role="dialog" aria-labelledby="addPostModalBtn" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-family: 'Jost', sans-serif; font-size: 1.5em; color: black; text-transform: uppercase">Добавить запись</h5>
                <button id="closeAddPostModalBtn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding:4px">


                @if(Auth::check())
                            <div class="mt-1 mb-1 mr-1 ml-1" style="padding-left: 0; padding-right: 0">
                                <div class="input-group">

                                    <div style="display: none" id="errors">
                                        <p><h6>Hey, where did the spammer go? So far, no more than 20 posts per day are possible. </h6></p>
                                    </div>
                                    <div style="display: none" id="null">
                                        <p><h6>Зачем отправляете пустую форму?</h6></p>
                                    </div>
                                    <div style="display: none" id="fileSize">
                                        <p><h6>Размер изображения не должен привышать 5мб</h6></p>
                                    </div>
                                    <div style="display: none" id="maxPhoto">
                                        <p><h6>Вы можете прикрепить максимум 10 изображений</h6></p>
                                    </div>

                                    <form action="{{route('profile.store', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data" id="form" class="mb-2">
                                        @csrf
                                        <textarea maxlength="100" class="form-control" id="title" name="title" cols="100" rows="2" placeholder="Заголовок новости, будет выделен жирным шрифтом. 100 символов"></textarea>
                                        <textarea maxlength="200" class="form-control mt-1" id="slug" name="slug" cols="100" rows="2" placeholder="Превью новости. 200 символов"></textarea>
                                        <textarea maxlength="5000" class="form-control mt-1" id="message" name="message" cols="100" rows="4" placeholder="Ваш текст. Будет виден только при открытии записи. 5000 сиволов"></textarea>
                                        <textarea maxlength="100" class="form-control mt-1" id="videoPost" name="videoPost" cols="100" rows="2" placeholder="Вставить видео с YouTube вида youtube.com/watch?v=eVTXPUF4Oz4"></textarea>
                                        <h6 id="bar"> </h6>
                                        <h6 id="count" style="margin: 0">5000</h6>
                                        <div class="row" style="margin: 0">
                                            <div class="col-6 text-left" style="padding: 0">
                                                <input type="file" id="img" name="img" class="mt-2" accept="image/*">
                                            </div>

                                            <div class="col-6 text-left" style="padding: 0">
                                                <input type="file" id="images" name="images[]" class="mt-2" accept="image/*" multiple>
                                            </div>

                                            <div class="col-6 text-right" style="padding: 0">
                                                <button type="submit" id="btn" class="btn btn-outline-dark btn-sm mt-2">Отправить</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                @endif

            </div>
        </div>
    </div>
</div>


<!--Mobile flash information about page-->
<div class="modal fade" id="mobileNav" tabindex="-1" role="dialog" aria-labelledby="mobileNav" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 style="font-size:1.3em">Адрес страницы</h5>
                <h5 style="font-size:1.1em" class="text-muted">{{route('profile', $user->nickname)}}</h5>
                <br>
                <h5 class="mt-2" style="font-size:1.3em">Поделиться страницей с друзьями</h5>
                <!-- uSocial -->
                <script async src="https://usocial.pro/usocial/usocial.js?v=6.1.4" data-script="usocial" charset="utf-8"></script>
                <div class="uSocial-Share" data-pid="4de7c49aa36779d3776b505ae3bf22cd" data-type="share" data-options="round-rect,style3,default,absolute,horizontal,size32,eachCounter1,counter0,nomobile" data-social="vk,twi,fb,telegram"></div>
                <!-- /uSocial -->
                <br>
                <h5 class="mt-2" style="font-size:1.3em">Перейти на главную</h5>
                <a href="{{route('musics')}}"><img src="{{asset('img/logo.png')}}" class="img-fluid mb-1" width="120px;"></a>
            </div>
        </div>
    </div>
</div>
<!--EndMobile flash information about page-->





<!-- Просмотр моих подписчиков -->
<div class="container">
    <div class="modal fade" id="subscribersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: 4px">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-family: 'Jost', sans-serif; font-size: 1.5em; color: black; text-transform: uppercase">Подписчики</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if(!$subscribers->count())
                    <h5 class="modal-title mt-2 mb-2 ml-1" id="exampleModalLabel" style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase">Нет подписчиков</h5>
                @else
                    <ul class="navbar-nav mb-2">
                    @foreach($subscribers as $subscriber)
                        <li class="nav-item mt-3">
                            <a href="http://{{$subscriber->subscriberPageLink}}">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="img-footer ml-1" style="padding: 0; background-image: url({{$subscriber->avatar ?? asset('img/noAvatar.png')}});"></div>
                                    </div>
                                    <div class="col-10" style="padding: 0">
                                        <h1 class="ml-2 mt-1" style="margin-bottom:0; font-family: 'Jost', sans-serif; font-size: 1.2em; color: black; ">{{$subscriber->name}}@if($subscriber->subscriberVerify)<img src="{{asset('img/verify2.png')}}" class="img-fluid ml-2" width="16px" title="Verified Page" style="margin-bottom: 4px">@endif</h1>
                                        <small class="ml-2">{{$subscriber->subscriberPageLink}}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Просмотр моих подписчиков -->





<!-- Просмотр моих подписок -->
<div class="container">
    <div class="modal fade" id="followersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding: 4px">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-family: 'Jost', sans-serif; font-size: 1.5em; color: black; text-transform: uppercase">Подписки</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if(!$followers->count())
                    <h5 class="modal-title mt-2 mb-2 ml-1" id="exampleModalLabel" style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase">Нет подписок</h5>
                @else
                    <ul class="navbar-nav mb-2">
                        @foreach($followers as $follower)
                            <li class="nav-item mt-3">
                                <a href="http://{{$follower->followerPageLink}}">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="img-footer ml-1" style="padding: 0; background-image: url({{$follower->avatar ?? asset('img/avatar.png')}});"></div>
                                        </div>
                                        <div class="col-10" style="padding: 0">
                                            <h1 class="ml-2 mt-1" style="margin-bottom:0; font-family: 'Jost', sans-serif; font-size: 1.2em; color: black; ">{{$follower->name}}@if($follower->followerVerify)<img src="{{asset('img/verify2.png')}}" class="img-fluid ml-2" width="16px" title="Verified Page" style="margin-bottom: 4px">@endif</h1>
                                            <small class="ml-2">{{$follower->followerPageLink}}</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Просмотр моих подписок -->





<!-- ++++++++++++++++++ Content ++++++++++++++++++ -->
<div class="container content">
    <div class="col-lg-12">
        <div class="row" >


            <!-- Mobile nav -->
            @if($user->banner)
                {{-- <div class="col-12 d-lg-none" style="padding: 0;">
                    <img src="{{$user->banner}}" class="img-fluid">
                </div> --}}
                <div class="col-12 d-lg-none" style="height:100px; background-size: cover; background-image: url({{$user->banner}})"></div>
            @endif

            <div class="col-12 menu left-column fixed-top sticky-top" id="menu">
                <div class="navbar navbar-dark " style="padding-left:8px; padding-right: 8px; background-color: #040404">
                    <a style="text-decoration: none" href="{{route('profile', $user->nickname)}}"><h1 class="display-4" style="font-family: 'Jost', sans-serif; font-size: 1.2em; margin-bottom: 0; color: #f4f4f2; text-transform: uppercase; "><b>{{$user->name}}</b>
                    @if($user->verify)
                        <img src="{{asset('img/verify2.png')}}" class="img-fluid ml-1" width="16px" title="Verified Page" style="margin-bottom: 4px">
                    @endif
                    </h1></a>
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
                                            <div class="media-body ml-1 mr-1">
                                                <h1 style="font-family: 'Raleway', sans-serif;font-size: 1em; color: #f7f6f0;">{{$user->about}}</h1>
                                                <h1 style="font-family: 'Raleway', sans-serif;font-size: 1em; color: #f7f6f0;"><a style="color:#f4d3b0;" href="http://{{$user->site}}">{{$user->site}}</a></h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item mt-3">
                                <div class="row" style="margin:0">
                                    <div class="col-5 text-left" style="padding:0">
                                        <h1 data-toggle="modal" data-target="#followersModal" style="margin:0;font-family: 'Jost', sans-serif; font-size: 1.2em; color: #f7f6f0; text-transform: uppercase">{{$user->iamfollower}}<small class="ml-2" style="color:snow">подписок</small></h1>
                                    </div>
                                    <div class="col-5 text-left" style="padding:0">
                                        <h1 data-toggle="modal" data-target="#subscribersModal" style="margin:0;font-family: 'Jost', sans-serif; font-size: 1.2em; color: #f7f6f0; text-transform: uppercase">{{$user->myfollowers}}<small class="ml-2" style="color:snow">подписчиков</small></h1>
                                    </div>
                                    @if(Auth::check())
                                        @if(Auth::user()->id != $user->id)
                                            <div class="col-2 text-right" style="padding:0">
                                                <form action="{{route('followUser', [Auth::user()->id, $user->id])}}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="followUserId{{$user->id}}" value="{{$user->id}}">
                                                    <button style="border: none; background-color: #040404; outline: none; padding-right:0px"><img class="img-fluid" width="60" src="{{ asset('img/follow.png') }}"></button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </li>
                            @if($events->count())
                            <li class="nav-item mt-3">
                                <a class="" href="{{route('events', ['id' => $user->id])}}" style="font-family: 'Jost', sans-serif; font-size: 1.2em; color: #f7f6f0; text-transform: uppercase">Мероприятия</a>
                            </li>
                            @endif
                            @if($mainAlbum->count())
                            <li class="nav-item mt-3">
                                <a class="" href="{{route('allAlbums', ['id'=>$user->id])}}" style="font-family: 'Jost', sans-serif; font-size: 1.2em; color: #f7f6f0; text-transform: uppercase">Музыка</a>
                            </li>
                            @endif
                            @if($mainVideo->count())
                            <li class="nav-item mt-3">
                                <a class="" href="{{route('allVideo', ['id'=>$user->id])}}" style="font-family: 'Jost', sans-serif; font-size: 1.2em; color: #f7f6f0; text-transform: uppercase">Видео</a>
                            </li>
                            @endif
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
            <!-- End Mobile nav-->
            <!-- EndLeft Column -->
{{--            @if(Auth::check())--}}
{{--                @if(Auth::user()->id == $user->id)--}}
{{--            <div class="container text-center" style="padding:0">--}}
{{--                <p style="margin:0">--}}
{{--                    <button style="border-radius: 0; background-color: #040404" class="btn btn-lg btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">--}}
{{--                        <h6 style="font-family: 'Jost', sans-serif; font-size: 1em; color: #f4f4f2">Сделать запись</h6>--}}
{{--                    </button>--}}
{{--                </p>--}}
{{--                <div class="collapse" id="collapseExample">--}}
{{--                    <div class="card card-body" style="margin:0">--}}

{{--                                <div class="mt-1 mb-1 mr-1 ml-1" style="padding-left: 0; padding-right: 0">--}}
{{--                                    <div class="input-group">--}}

{{--                                        <div style="display: none" id="errors">--}}
{{--                                            <p><h6>Hey, where did the spammer go? So far, no more than 20 posts per day are possible. </h6></p>--}}
{{--                                        </div>--}}
{{--                                        <div style="display: none" id="null">--}}
{{--                                            <p><h6>Why send an empty form?</h6></p>--}}
{{--                                        </div>--}}
{{--                                        <div style="display: none" id="fileSize">--}}
{{--                                            <p><h6>What a great. Image size should not exceed 5 mb</h6></p>--}}
{{--                                        </div>--}}

{{--                                        <form action="{{route('profile.store', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data" id="form" class="mb-2">--}}
{{--                                            @csrf--}}
{{--                                            <textarea maxlength="100" class="form-control" id="title" name="title" cols="100" rows="2" placeholder="Заголовок новости, будет выделен жирным шрифтом. 100 символов"></textarea>--}}
{{--                                            <textarea maxlength="200" class="form-control mt-1" id="slug" name="slug" cols="100" rows="2" placeholder="Превью новости. 200 символов"></textarea>--}}
{{--                                            <textarea maxlength="5000" class="form-control mt-1" id="message" name="message" cols="100" rows="4" placeholder="Ваш текст. Будет виден только при открытии записи. 5000 сиволов"></textarea>--}}
{{--                                            <textarea maxlength="100" class="form-control mt-1" id="videoPost" name="videoPost" cols="100" rows="2" placeholder="Вставить видео с YouTube вида youtube.com/watch?v=eVTXPUF4Oz4"></textarea>--}}
{{--                                            <h6 id="bar"> </h6>--}}
{{--                                            <h6 id="count" style="margin: 0">5000</h6>--}}
{{--                                            <div class="row" style="margin: 0">--}}
{{--                                                <div class="col-6 text-left image-upload" style="padding: 0">--}}
{{--                                                    <label for="img" style="margin: 0">--}}
{{--                                                        <img src="{{asset('img/footer/img.png')}}" class="img-fluid mt-1" width="30"/>--}}
{{--                                                    </label>--}}
{{--                                                    <input type="file" id="img" name="img" class="mt-2" accept="image/*">--}}
{{--                                                </div>--}}
{{--                                                <div class="col-6 text-right" style="padding: 0">--}}
{{--                                                    <button type="submit" id="btn" class="btn btn-outline-dark btn-sm mt-1">Отправить</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @endif--}}
{{--        @endif--}}
            <!-- Right Column -->

            <div class="col-lg-12 right-column" >
                @if($posts->count() != 0)
                <div class="">
                @endif

{{--                    @if(Auth::check())--}}
{{--                        @if(Auth::user()->id == $user->id)--}}
{{--                            <div class="mt-1 mb-1 mr-1 ml-1" style="padding-left: 0; padding-right: 0">--}}
{{--                                <div class="input-group">--}}

{{--                                    <div style="display: none" id="errors">--}}
{{--                                        <p><h6>Hey, where did the spammer go? So far, no more than 20 posts per day are possible. </h6></p>--}}
{{--                                    </div>--}}
{{--                                    <div style="display: none" id="null">--}}
{{--                                        <p><h6>Why send an empty form?</h6></p>--}}
{{--                                    </div>--}}
{{--                                    <div style="display: none" id="fileSize">--}}
{{--                                        <p><h6>What a great. Image size should not exceed 5 mb</h6></p>--}}
{{--                                    </div>--}}

{{--                                    <form action="{{route('profile.store', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data" id="form" class="mb-2">--}}
{{--                                        @csrf--}}
{{--                                        <textarea maxlength="100" class="form-control" id="title" name="title" cols="100" rows="2" placeholder="Заголовок новости, будет выделен жирным шрифтом. 100 символов"></textarea>--}}
{{--                                        <textarea maxlength="200" class="form-control mt-1" id="slug" name="slug" cols="100" rows="2" placeholder="Превью новости. 200 символов"></textarea>--}}
{{--                                        <textarea maxlength="5000" class="form-control mt-1" id="message" name="message" cols="100" rows="4" placeholder="Ваш текст. Будет виден только при открытии записи. 5000 сиволов"></textarea>--}}
{{--                                        <textarea maxlength="100" class="form-control mt-1" id="videoPost" name="videoPost" cols="100" rows="2" placeholder="Вставить видео с YouTube вида youtube.com/watch?v=eVTXPUF4Oz4"></textarea>--}}
{{--                                        <h6 id="bar"> </h6>--}}
{{--                                        <h6 id="count" style="margin: 0">5000</h6>--}}
{{--                                        <div class="row" style="margin: 0">--}}
{{--                                            <div class="col-6 text-left image-upload" style="padding: 0">--}}
{{--                                                <label for="img" style="margin: 0">--}}
{{--                                                    <img src="{{asset('img/footer/img.png')}}" class="img-fluid mt-1" width="30"/>--}}
{{--                                                </label>--}}
{{--                                                <input type="file" id="img" name="img" class="mt-2" accept="image/*">--}}
{{--                                            </div>--}}
{{--                                            <div class="col-6 text-right" style="padding: 0">--}}
{{--                                                <button type="submit" id="btn" class="btn btn-outline-dark btn-sm mt-1">Отправить</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    @endif--}}
                    <div id="deletePost">

                    </div>


                    <!-- Вкладки -->
                    @if(Auth::check())
                        @if(Auth::user()->id == $user->id)
                            <div class="col-12" style="padding: 0; background-color: #e9e7db">
                                <ul class="nav nav-tabs nav-pills nav-fill" style="border:0">
                                    <!-- Первая вкладка (активная) -->
                                    <li class="nav-item active" style="margin-bottom:0">
                                        <a class="nav-link " data-toggle="tab" href="#description" style="background-color: #e9e7db; border: 0; font-family: 'Jost', sans-serif; font-size: 1em; color: #040404;">Новости</a>
                                    </li>
                                    <!-- Вторая вкладка -->
                                    <li class="nav-item ">
                                        <a class="nav-link " data-toggle="tab" href="#characteristics" style="background-color: #e9e7db; border: 0; font-family: 'Jost', sans-serif; font-size: 1em; color: #040404;">Мои записи</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endif
{{--@dd($followersPosts)--}}

                    <div class="tab-content col-12" style="padding: 0">
                        <!-- Первый блок (он отображается по умолчанию, т.к. имеет классы show и active) -->
                        @if(!Auth::check())
                            <div class="tab-pane fade infinite-scroll-follower" id="description">
                        @endif
                        @if(Auth::check())
                            @if(Auth::user()->id != $user->id)
                                <div class="tab-pane fade infinite-scroll-follower" id="description">
                            @endif
                            @if(Auth::user()->id == $user->id)
                                <div class="tab-pane fade show active infinite-scroll-follower" id="description">
                            @endif
                        @endif

                        @if($followersPosts->count() == 0)
                            <div class="text-center mt-5" style="padding: 0">
                                <h6>Новостей нет</h6>
                                <h6>Подпишитесь на пользователей, что бы получать их обновления</h6>
                            </div>
                        @endif

                        @foreach($followersPosts as $followersPost)

                                <div class="modal fade" id="postModal{{$followersPost->id}}" tabindex="-1" role="dialog" aria-labelledby="postModal{{$followersPost->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content" id="postEdit">

                                            <div class="modal-body text-center">
                                                <h6>Генерировать короткую ссылку на пост</h6>
                                                <form action="{{route('generateShortLink')}}" method="POST" id="generateShortFollowerPostLinkForm{{$followersPost->id}}">
                                                    @csrf
                                                    <input type="hidden" name="old_link" value="{{route('userPost', ['id' => $followersPost->user_id, 'postId' => $followersPost->id])}}">
                                                    <button class="btn-sm btn btn-dark" type="submit" data-id="{{ $followersPost->id }}" id="generateShortFollowerPostLink{{$followersPost->id}}">push</button>
                                                </form>
                                                <h6 id="showNewFollowerPostLink{{$followersPost->id}}" class="mt-3"></h6>

                                                <button class="fbtn-clipboard-{{$followersPost->id}} btn btn-outline-dark btn-sm" data-clipboard-target="#showNewFollowerPostLink{{$followersPost->id}}" style="display:none">
                                                    copy
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="  list-group-item  textpost allalbums" id="textpostdata{{$followersPost->id}}" data-id="{{$followersPost->id}}" style="margin: 0; border-top:1px; border-right: 0; border-left: 0;">
                                    <div class="media">
                                        <div class="img-post d-none d-xl-block" style="background-image: url({{$user->avatar ?? asset('img/default-ava.jpg')}});"></div>
                                        <div class="media-body">

                                            <div id="userPost{{$followersPost->id}}">

                                                <div class="row mt-1 ml-1 mr-1">
                                                    <div class="col-8" style="padding: 0;">
                                                        <a href="http://{{$followersPost->followerPageLink}}" style="text-decoration: none">
                                                            <h5 style="font-family: 'Jost', sans-serif; font-size: 1.2em; margin-bottom: 0; color: black;">
                                                                {{$followersPost->name}}
                                                                @if($followersPost->followerVerify)
                                                                    <img src="{{asset('img/verify2.png')}}" class="img-fluid ml-1" width="16px" title="Verified Page" style="margin-bottom: 4px">
                                                                @endif
                                                            </h5>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 text-right" style="padding: 0">
                                                        <small>{{$followersPost->created_at}}</small>
                                                    </div>
                                                </div>

                                                @if($followersPost->img)
                                                    <div style="position: relative;">
                                                        <a href="{{route('userPost', ['id' => $followersPost->user_id, 'postId' => $followersPost->id])}}" style="text-decoration: none"><img  src="{{$followersPost->img}}" class="img-fluid"></a>
                                                    </div>
                                                @endif
                                                @if($followersPost->title)
                                                    <div class="mr-1 titleleft">
                                                        <a href="{{route('userPost', ['id' => $followersPost->user_id, 'postId' => $followersPost->id])}}" style="text-decoration: none"><h4 class="mt-2" style="color: #14110f; font-family: 'Jost', sans-serif; font-size: 1.5em; line-height: 1; color: #14110f"><b>{{$followersPost->title}}</b></h4></a>
                                                    </div>
                                                @endif
                                                @if($followersPost->slug)
                                                    <a href="{{route('userPost', ['id' => $followersPost->user_id, 'postId' => $followersPost->id])}}" style="text-decoration: none"><div class="text-small margins mt-2" style="white-space: pre-wrap; font-family: 'Lora', serif; font-weight: 300; font-size: 1.3em; line-height: 1.1; color: #34312d">{{$followersPost->slug}}</div></a>
                                                @endif
                                                @if($followersPost->slug == false || $followersPost->title == false)
                                                    <a href="{{route('userPost', ['id' => $followersPost->user_id, 'postId' => $followersPost->id])}}" style="text-decoration: none"><div class="text-small margins mt-2 profileMessage" style="white-space: pre-wrap; font-family: 'Ledger', serif; font-weight: 300; font-size: 1.5em; color: #34312d">{{$followersPost->message}}</div></a>
                                                @endif
                                                @if($followersPost->videoPost)
                                                    <div class="embed-responsive embed-responsive-16by9 mt-2 ">
                                                        <iframe class="embed-responsive-item" src="{{$followersPost->videoPost}}" allowfullscreen></iframe>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="row mt-3  mb-1" style="margin-left: 5px; margin-right: 0">
                                                <div class="col-6" style="padding: 0">
                                                    @if(Auth::check())

                                                        <form action="{{route('likePost', ['id' => Auth::user()->id, 'postId' => $followersPost->id])}}" method="POST" id="likeSubscribeForm{{$followersPost->id}}">@endif
                                                            @csrf @method('PATCH')
                                                            @if(Auth::check())
                                                                <button data-id="{{$followersPost->id}}" id="likSubscribeBtn" type="submit" class="button-delete-post-2" style="padding: 0; outline: none;">@endif
                                                                    <img id="notLike{{$followersPost->id}}" src="{{asset('img/footer/like.png')}}" class="img-fluid" width="15" style="margin-right:4px">
                                                                    <img style="display: none;" id="itsLike{{$followersPost->id}}" src="{{asset('img/footer/liked.png')}}" class="img-fluid" width="15" style="margin-right:4px">
                                                                    <small id="likeSubscribeCount{{$followersPost->id}}" class="text-muted mr-3" style="font-size: 0.9em">{{$followersPost->likepost}}</small>@if(Auth::check())
                                                                </button>@endif
                                                            <img src="{{asset('img/footer/com.png')}}" class="img-fluid" width="23"><small class="text-muted" style="font-size: 0.9em">{{$followersPost->commentCount}}</small>
                                                            @if(Auth::check())
                                                                <input type="hidden" value="{{Auth::user()->id}}" id="subscriberUser_id">
                                                            @endif
                                                        </form>
                                                </div>
                                                <div class="col-6" style="padding: 0">
                                                    <h6 class="text-muted text-right mr-1" style="margin-bottom:0; margin-top: 4px; font-size: 0.8em;"><img class="ml-3 mr-1" src="{{asset('img/footer/zakladka.png')}}" width="9" data-toggle="modal" data-target="#postModal{{$followersPost->id}}"></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{$followersPosts->links()}}
                        @endforeach
                        </div>


                        <!-- Второй блок -->
                        @if(Auth::check())
                            @if(Auth::user()->id == $user->id)
                                <div class="tab-pane fade" id="characteristics">
                            @endif
                            @if(Auth::user()->id == $user->id)
                                <div class="tab-pane fade show active" id="characteristics">
                            @endif
                        @endif

                            <div class="infinite-scroll" id="textpost">
                            @foreach($posts as $post)

                                <!-- Modal Edit Post-->
                                    <div class="modal fade" id="editPost{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="editPost" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" id="postEdit">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Редактировать запись</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeButton{{$post->id}}">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('editPost', ['id' => $user->id, 'postId' => $post->id])}}" method="post" enctype="multipart/form-data" id="EditPostForm{{$post->id}}" name="postForm">
                                                        @csrf @method('PATCH')
                                                        <div class="form-group">
                                                            <textarea id="editTitle" maxlength="100" name="title" class="form-control" rows="1">{{$post->title}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea id="editTitle" maxlength="200" name="slug" class="form-control" rows="5">{{$post->slug}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea id="editMessage" maxlength="5000" name="message" class="form-control" rows="10">{{$post->message}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea id="editVideo" maxlength="100" class="form-control mt-1" id="videoPost" name="videoPost" cols="100" rows="1">{{$post->videoPost}}</textarea>
                                                        </div>
                                                        <h6>Текущее изображение</h6>
                                                        <img src="{{$post->img}}" class="img-fluid mb-2" width="230">

                                                        <div class="form-group">
                                                            <input type="file" id="img" name="img" accept="image/*">
                                                            <p><small>Max file size 5mb(jpeg,png,gif,jpg)</small></p>
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

                                                        <input type="hidden" value="{{$post->user_id}}" id="userForm">

                                                        <button type="submit" class="btn btn-sm btn-dark" id="editPostButton" data-id="{{ $post->id }}">Редактировать</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->


                                    <!-- Post Modal-->
                                    <div class="modal fade" id="postModal{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="postModal{{$post->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content" id="postEdit">

                                                <div class="modal-body text-center">
                                                    <h6>Генерировать короткую ссылку на пост</h6>
                                                    <form action="{{route('generateShortLink')}}" method="POST" id="generateShortLinkForm{{$post->id}}">
                                                        @csrf
                                                        <input type="hidden" name="old_link" value="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}">
                                                        <button class="btn-sm btn btn-dark" type="submit" data-id="{{ $post->id }}" id="generateShortLink{{$post->id}}">push</button>
                                                    </form>
                                                    <h6 id="showNewLink{{$post->id}}" class="mt-3"></h6>

                                                    <button class="btn-clipboard-{{$post->id}} btn btn-outline-dark btn-sm" data-clipboard-target="#showNewLink{{$post->id}}" style="display:none">
                                                        copy
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Post Modal-->

                                    <div class=" list-group-item textpost allalbums mb-1" id="textpostdata{{$post->id}}" data-id="{{$post->id}}" style="margin: 0; border-top:1px; border-right: 0; border-left: 0;">
                                        <div class="media">
                                            <div class="img-post d-none d-xl-block" style="background-image: url({{$user->avatar ?? asset('img/default-ava.jpg')}});"></div>
                                            <div class="media-body">

                                                <div id="userPost{{$post->id}}">
                                                    @if($post->img)
                                                        <div style="position: relative;">
                                                            <a href="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" style="text-decoration: none"><img style="" src="{{$post->img}}" class="img-fluid"></a>
                                                        </div>
                                                    @endif

                                                    @if($post->title)
                                                        <div class="mr-1 titleleft">
                                                            <a href="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" style="text-decoration: none"><h4 class="mt-2" style="color: #14110f; font-family: 'Jost', sans-serif; font-size: 1.5em; line-height: 1; color: #14110f"><b>{{$post->title}}</b></h4></a>
                                                        </div>
                                                    @endif
                                                    @if($post->slug)
                                                        <a href="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" style="text-decoration: none"><div class="text-small margins mt-2" style="white-space: pre-wrap; font-family: 'Lora', serif; font-weight: 300; font-size: 1.3em; line-height: 1.1; color: #34312d">{{$post->slug}}</div></a>
                                                    @endif
                                                    @if($post->slug == false || $post->title == false)
                                                        <a href="{{route('userPost', ['id' => $user->id, 'postId' => $post->id])}}" style="text-decoration: none"><div class="text-small margins mt-2 profileMessage" style="white-space: pre-wrap; font-family: 'Ledger', serif; font-weight: 300; font-size: 1.5em; color: #34312d">{{$post->message}}</div></a>
                                                    @endif
                                                    @if($post->videoPost)
                                                        <div class="embed-responsive embed-responsive-16by9 mt-2">
                                                            <iframe class="embed-responsive-item" src="{{$post->videoPost}}" allowfullscreen></iframe>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row mt-3  mb-1" style="margin-left: 5px; margin-right: 0">
                                                    <div class="col-6" style="padding: 0">
                                                        @if(Auth::check())

                                                            <form action="{{route('likePost', ['id' => Auth::user()->id, 'postId' => $post->id])}}" method="POST" id="likeForm{{$post->id}}">@endif
                                                                @csrf @method('PATCH')
                                                                @if(Auth::check())
                                                                    <button data-id="{{$post->id}}" id="likebtn" type="submit" class="button-delete-post-2" style="padding: 0; outline: none;">@endif
                                                                        <img id="notLike{{$post->id}}" src="{{asset('img/footer/like.png')}}" class="img-fluid" width="15" style="margin-right:4px">
                                                                        <img style="display: none;" id="itsLike{{$post->id}}" src="{{asset('img/footer/liked.png')}}" class="img-fluid" width="15" style="margin-right:4px">
                                                                        <small id="likeCount{{$post->id}}" class="text-muted mr-3" style="font-size: 0.9em">{{$post->likepost}}</small>@if(Auth::check())
                                                                    </button>@endif
                                                                <img src="{{asset('img/footer/com.png')}}" class="img-fluid" width="23"><small class="text-muted" style="font-size: 0.9em">{{$post->comments()->count()}}</small>
                                                                @if(Auth::check())
                                                                    <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                                                                @endif
                                                            </form>
                                                    </div>
                                                    <div class="col-6" style="padding: 0">

                                                        <h6 class="text-muted text-right mr-1" style="margin-bottom:0; margin-top: 4px; font-size: 0.8em;">{{$post->created_at->diffForHumans()}}<img class="ml-3 mr-1" src="{{asset('img/footer/zakladka.png')}}" width="9" data-toggle="modal" data-target="#postModal{{$post->id}}"></h6>
                                                        @if(Auth::check())
                                                            @if(Auth::user()->id == $user->id)
                                                                <div class="text-right mt-3">

                                                                    <form action="{{route('deletePost', ['id' => $post->id])}}" method="post" id="formDelete">
                                                                        @csrf @method('DELETE')
                                                                        <img src="{{asset('img/footer/edit.png')}}" class="img-fluid" width="25" data-toggle="modal" data-target="#editPost{{$post->id}}">
                                                                        <button style="margin-right:0; padding-right:0; background-color:#ffffff; outline: none;" type="submit" id="delete" class="button-delete-post margins py-0" data-id="{{ $post->id }}"><img src="{{asset('img/footer/del.png')}}" class="img-fluid" width="25"></button>
                                                                    </form>

                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{$posts->links()}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Вкладки -->


{{--                    <div class="pagination" style="margin-top: 0px;">--}}
{{--                        <div class="text-center pagination-lg">{{$posts->links('vendor.pagination.bootstrap-4')}}</div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <!-- End Right Column-->
        </div>
    </div>
</div>

@if(Auth::check())
@if(Auth::user()->id == $user->id)
<div class="container ">
    <div class="row ">
        <div class="col-lg-12 ">
            <nav class=" fixed-bottom " style="background-color: #040404">
                <div class="row">
                    <div class="col-12 ">

                        <div class="row text-center">
                            <div class="col-12">
                                <h6 style="margin-top:2px; font-family: 'Jost', sans-serif; font-size: 1em; margin-bottom: 0; color: #f8ceab; text-transform: uppercase; " data-toggle="modal" data-target="#addPostModalBtn">Добавить запись</h6>
                            </div>
                        </div>

                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
@endif
@endif
</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.3.7/jquery.jscroll.min.js"></script>

{{--Подгрузка постов--}}
{{--<script type="text/javascript">--}}
{{--    $('ul.pagination').hide();--}}
{{--    $(function() {--}}
{{--        $('.infinite-scroll').jscroll({--}}
{{--            autoTrigger: true,--}}
{{--            debug: true,--}}
{{--            loadingHtml: '<img class="center-block" src="{{asset('img/loading.gif')}}" alt="Loading..." />',--}}
{{--            padding: 2,--}}
{{--            nextSelector: '.pagination li.active + li a',--}}
{{--            contentSelector: '.infinite-scroll',--}}
{{--            callback: function() {--}}
{{--                $('ul.pagination').remove();--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}

{{--Публикация постов--}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $( "#form" ).submit(function( e ) {
        e.preventDefault();

        var formData = new FormData(this); //set formData to selected instance
        var title = $('#title').val();
        var message = $('#message').val();
        var img = $('#img').val();
        var videoPost = $('#videoPost').val();
        var slug = $('#slug').val();
        var user_id = $('#user_id').val();


        var numFiles = $('#images').get(0).files.length




        var fileSize = document.getElementById("img");

        $.ajax({
            type: "POST",
            @if(Auth::check())
            url: "{{route('profile.store', ['id' => Auth::user()->id])}}",
            @endif
            data: formData,
            beforeSend: function(data) {
                if(title == '' && slug == '' && message == '' && img == '' && videoPost == '') {
                    $("#null").show();
                    return false;
                }
                $("#null").hide();
                // if(fileSize.files[0].size > 5000000) {
                //     $("#fileSize").show();
                //     return false;
                // }
                // $("#fileSize").hide();
                if(numFiles > 10) {
                    $("#maxPhoto").show();
                    return false;
                }
                $("#maxPhoto").hide();
            },
            success: function (data) {
                $("#textpost").html($(data).find("#textpost").html());
                $('#title').val('').change();
                $('#slug').val('').change();
                $('#message').val('').change();
                $('#img').val('').change();
                $('#videoPost').val('').change();

                $('#closeAddPostModalBtn').click();
            },
            error: function(data) {
                $("#errors").show();
            },
            contentType: false,
            processData: false,
        });

        $("#errors").hide();

    });
</script>

{{--Удаление постов--}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $("body").on("click","#delete",function(e){
            e.preventDefault();

            var id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: "delete/"+id,
                type: 'DELETE',
                data: {_token: token, id: id},
                success: function (){
                    $("div.textpost[data-id="+id+"]").remove();
                },
            });

        });
    });
</script>

{{--Подсчет символов--}}
<script type="text/javascript">

    $(document).ready(function() {
        $("#message").keyup(function() {
            var message = $(this).val();
            var main = message.length *100;
            var value= (main / 5000);
            var count= 5000 - message.length;

            if(message.length <= 1500)
            {
                $('#count').html(count);
                $('#bar').animate(
                    {
                        "width": value+'%',
                    }, 1);
            }
            else
            {
                return false;
            }
            return false;
        });
    });

</script>

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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.infinite-scroll').on('click', '#editPostButton', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var user_id = $('#userForm').val();
        var form = document.getElementById('EditPostForm'+id);
        var formData = new FormData(form);

        $.ajax({
            url: "id"+user_id+"/"+id+"/edit",
            type: "POST",
            data: formData,
            success: function(data) {
                // console.log(data);
                $("#userPost"+id).html($(data).find("#userPost"+id).html());
                // $("#userPost"+id).html(data);
                $("#closeButton"+id).click();
            },
            error: function() {
                console.log('error');
            },
            processData: false,
            contentType: false,
        });

    });
</script>

{{--Лайк постов моих постов--}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.infinite-scroll').on('click', '#likebtn', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var token = $("meta[name='csrf-token']").attr("content");
        var user_id = $("#user_id").val();
        var formData = $("#likeForm"+id).serialize();

        $.ajax({
            url: "id"+user_id+"/"+id+"/like",
            type: "PATCH",
            data: formData,
            dataType:'html',
            success: function(data) {
                $("#likeCount"+id).html(data);
            },
            error: function() {
                alert('baaaad');
            },
            contentType: false,
            processData: false,
        });
    });
</script>

{{--Мои посты--}}
@foreach($posts as $post)
<script type="text/javascript">
    $('.infinite-scroll').on('click', '#generateShortLink{{$post->id}}', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var form = $('#generateShortLinkForm'+id).serialize();

        $.ajax({
            url: "generate",
            type: "POST",
            data: form,
            success: function(data) {
                $("#showNewLink"+id).html(data);
            },
            error: function() {
                alert('errorroror');
            },

        });

    });
</script>

<script type="text/javascript">
    var clipboard = new Clipboard('.btn-clipboard-{{$post->id}}');
    clipboard.on('success', function(e) {
        console.info('Действие:', e.action);
        console.info('Текст:', e.text);
        console.info('Триггер:', e.trigger);
        e.clearSelection();
    });
    clipboard.on('error', function(e) {
        console.error('Действие:', e.action);
        console.error('Триггер:', e.trigger);
    });
</script>

<script type="text/javascript">
    $("#generateShortLink{{$post->id}}").click(function() {
        $(".btn-clipboard-{{$post->id}}").show();
    })
</script>
@endforeach

{{--Посты тех, на кого подписан--}}
@foreach($followersPosts as $followersPost)

    <script type="text/javascript">
        $('.infinite-scroll-follower').on('click', '#generateShortFollowerPostLink{{$followersPost->id}}', function(e) {
            e.preventDefault();

            // var id = $(this).data('id');
            // var form = $('#generateShortFollowerPostLinkForm'+id).serialize();
            var form = $('#generateShortFollowerPostLinkForm{{$followersPost->id}}').serialize();

            $.ajax({
                url: "generate",
                type: "POST",
                data: form,
                success: function(data) {
                    $("#showNewFollowerPostLink{{$followersPost->id}}").html(data);
                },
                error: function() {
                    alert('errorroror');
                },

            });

        });
    </script>

    <script type="text/javascript">
        var clipboard = new Clipboard('.fbtn-clipboard-{{$followersPost->id}}');
        clipboard.on('success', function(e) {
            console.info('Действие:', e.action);
            console.info('Текст:', e.text);
            console.info('Триггер:', e.trigger);
            e.clearSelection();
        });
        clipboard.on('error', function(e) {
            console.error('Действие:', e.action);
            console.error('Триггер:', e.trigger);
        });
    </script>

    <script type="text/javascript">
        $("#generateShortFollowerPostLink{{$followersPost->id}}").click(function() {
            $(".fbtn-clipboard-{{$followersPost->id}}").show();
        })
    </script>
@endforeach


{{--Лайк постов на кого подписан--}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.infinite-scroll-follower').on('click', '#likSubscribeBtn', function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var token = $("meta[name='csrf-token']").attr("content");
        var user_id = $("#subscriberUser_id").val();
        var formData = $("#likeSubscribeForm"+id).serialize();

        $.ajax({
            url: "id"+user_id+"/"+id+"/like",
            type: "PATCH",
            data: formData,
            dataType:'html',
            success: function(data) {
                $("#likeSubscribeCount"+id).html(data);
            },
            error: function() {
                alert('baaaad');
            },
            contentType: false,
            processData: false,
        });
    });
</script>

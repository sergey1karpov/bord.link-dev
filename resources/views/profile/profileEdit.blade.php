<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>bord.link edit profile</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Your collection of microservices for social networks"/>
    <meta name="keywords" content="Your collection of microservices for social networks"/>

    <!-- Open Graph tags-->
    <meta property="og:title" content="bord.link - Your collection of microservices for social networks" />
    <meta property="og:url" content="http://www.bord.link" />
    <meta property="og:site_name" content="bord.link" />
    <meta property="og:description" content="Your collection of microservices for social networks" />
    <meta property="og:image" content="{{$post->img_link ?? asset('img/logo4.png')}}"/>
    <meta property="og:type" content="website" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9bd26323f9.js" crossorigin="anonymous"></script>

    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">

    <!-- Bootstrap and CSS-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

    <script src="{{ asset('js/app.js') }}"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

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
</head>
<body>





<div class="container" style="padding: 0">
    <div class="row" style="margin:0;">
        @if ($errors->any())
            <div class="col-lg-12">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <!-- Mobile banner -->

            <div class="col-12 menu left-column fixed-top sticky-top mb-3" id="menu">
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
                                            <h1 style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('allVideo', ['id' => Auth::user()->id])}}">Мои видеозаписи</a></h1>
                                            <h1 style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('allAlbums', ['id' => Auth::user()->id])}}">Мои релизы</a></h1>
                                            <h1 style="font-family: 'Jost', sans-serif; font-size: 0.9em; color: #f7f6f0; text-transform: uppercase; padding:0"><a style="color:#f4d3b0;" href="{{route('events', ['id' => Auth::user()->id])}}">Мои мероприятия</a></h1>

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
            <!-- EndMobile Banner-->

            <!-- Mobile -->
            @if (session('status'))
            <div class="col-12">
                <div class="alert alert-success text-center" role="alert">
                    {{ session('status') }}
                </div>
            </div>
            @endif
            <div class="col-12 d-lg-none text-center" style="margin-bottom: 8px; padding: 0;">
                <h4 style="font-family: 'Jost', sans-serif; font-size: 1.5em; color: black; text-transform: uppercase;" class="text-center ">Редактировать профиль</h4>
                <hr>
                @if($user->banner)
                    <h5 style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase;" class="text-center ">Текущий баннер</h5>
                    <img src="{{$user->banner}}" class="img-fluid" width="500">
                    <form action="{{route('deleteBanner', ['id' => $user->id])}}" method="post" class="text-center">
                        @csrf @method('PATCH')
                        <input type="submit" class="btn btn-sm btn-dark mt-2" value="Удалить">
                    </form>
                @endif
                @if($user->banner)
                <hr>
                @endif
                <form class="" style="margin-left: 5px; margin-right: 5px" action="{{route('editProfileInformation', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <h6 style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase;" class="mt-2 mb-1 text-center">Имя пользователя</h6>
                        <input maxlength="23" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="{{$user->name}}">
                        <small>Имя пользователя не должно превышать 23 символов</small>
                    </div>
                    <div class="form-group">
                        <h6 style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase;" class="mt-2 mb-1 text-center">Nickname</h6>
                        <input maxlength="50" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nickname" value="{{$user->nickname}}">
                        <small>Nickname не должен превышать 50 символов</small>
                    </div>
                    <div class="form-group">
                        <h6 style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase;" class="mt-2 mb-1 text-center">Адрес вашего сайта</h6>
                        <input maxlength="50" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Your personal website" name="site" value="{{$user->site}}">
                    </div>
                    <div class="form-group">
                        <h6 style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase;" class="mt-2 mb-1 text-center">Обо мне</h6>
                        <textarea maxlength="150" name="about" class="form-control" rows="6">{{$user->about}}</textarea>
                        <small id="emailHelp" class="form-text text-muted text-center">Раздел "Обо мне" не должен превышать 150 символов</small>
                    </div>
                    <div class="form-group">
                        <h6 style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase;" class="mt-2 mb-1 text-center">Загрузить фото профиля</h6>
                        <input accept="image/*" type="file" name="avatar" value="{{$user->avatar}}">
                    </div>
                    <div class="form-group">
                        <h6 style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase;" class="mt-2 mb-1 text-center">Загрузить баннер профиля</h6>
                        <input accept="image/*" type="file" name="banner" value="{{$user->banner}}">
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-dark text-center">Редактировать</button>
                    <hr>
                </form>
                <form class="text-center" action="{{route('deleteUser', ['id' => Auth::user()->id])}}" method="post">
                    @csrf @method('DELETE')
                    <div class="form-group">
                        <h6 style="font-family: 'Jost', sans-serif; font-size: 0.8em; color: black; text-transform: uppercase;" class="mt-2 mb-1 text-center">Удалить страницу</h6>
                        <input type="submit" value="Удалить" class="mt-2 btn btn-danger btn-sm">
                    </div>
                </form>
            </div>
    </div>
    </div>
</div>


</body>
</html>





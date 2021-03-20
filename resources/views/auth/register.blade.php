@extends('layouts.layout')

@section('content')
<div class="container" style="margin-top: 150px; margin-bottom: 100px">
    <div class="row justify-content-center">
        <div class="col-md-12" style="padding: 0">

{{--                <div class="card-header text-center">{{ __('Регистрация') }}</div>--}}

                <div class="card-body mt-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row text-center">
                            <label for="name" class="col-md-4 col-form-label text-md-right" style="margin-top: 0">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Виталий Наливкин" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <small class="text-muted">От 5 до 25 символов</small>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <label for="nickname" class="col-md-4 col-form-label text-md-right" style="margin-top: 0">{{ __('URL name') }}</label>

                            <div class="col-md-6">
                                <input placeholder="nalivkin" id="nickname" type="text" class="form-control @error('nickname') is-invalid @enderror" name="nickname" value="{{ old('nickname') }}" required autocomplete="nickname" autofocus>
                                <small class="text-muted">От 5 до 20 символов,для формирования адреса bord.link/ваше_имя</small>
                                @error('nickname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="margin-top: 0">{{ __('E-Mail адрес') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <small class="text-muted">Максимальное кол-во символов 255</small>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="margin-top: 0">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <small class="text-muted">Ваш пароль должен содержать минимум 8 символов</small>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row text-center">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right" style="margin-top: 0">{{ __('Подтвердите пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 offset-md-4 ">
                                {!! htmlFormSnippet([
                                    "theme" => "light",
                                    "size" => "normal",
                                    "tabindex" => "3",
                                    "callback" => "callbackFunction",
                                    "expired-callback" => "expiredCallbackFunction",
                                    "error-callback" => "errorCallbackFunction",
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-center mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-dark">
                                    {{ __('Завершить регистрацию') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

        </div>
    </div>
</div>
@endsection

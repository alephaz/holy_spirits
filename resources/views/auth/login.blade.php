@extends('layouts.app')

@section('title','Login')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3
                                class="card-title text-blue">{{ __('common.partner_login_title') }}</h3></div>

                    <div class="card-body">

                        {{--<div class="alert alert-info">--}}
                            {{--@if(app()->getLocale() == 'en')--}}
                                {{--<h3>Partners will receive an email in the next few days to reset their password on the--}}
                                    {{--new website.--}}
                                    {{--<br><br> Thank you!</h3>--}}
                            {{--@endif--}}
                            {{--@if(app()->getLocale() == 'es')--}}
                                {{--<h3>Los patrocinadores recibirán un correo electrónico en los próximos días para--}}
                                    {{--reestablecer su contraseña en la nueva página web.--}}
                                    {{--<br><br> Muchas gracias!</h3>--}}
                            {{--@endif--}}
                            
                            {{--@if(app()->getLocale() == 'iw')--}}
                                {{--<h3>השותפים יקבלו דוא"ל בימים הקרובים כדי לאפס את הסיסמה שלהם ב---}}
                                    {{--אתר אינטרנט חדש.--}}
                                    {{--<br><br> תודה!</h3>--}}
                            {{--@endif--}}
                        {{--</div>--}}

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('common.partner_login_email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('common.partner_login_password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('common.partner_login_remember') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('common.partner_login_login') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('common.partner_login_forgot') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@if(app()->getLocale() === 'en')
    @section('title','Create new password')
@endif

@if(app()->getLocale() === 'es')
    @section('title','Crear nueva contraseña')
@endif

@section('content')
    <div class="container">
        @if(app()->getLocale() == 'en')

            <b>Dear Partners,</b><br><br>

            <p>We have created a new website for the ministry, and we would like to give you access to the new partner’s
                interface. From this location you will be able to read the book “My Beloved Holy Spirit” and also have
                access to audio and video teachings from different conferences and crusades.
                We believe that the call to share the gospel is urgent and of eternal significance. It is our desire to
                share the gospel in love and power, and represent Jesus with integrity and excellency. His love for us,
                and our love for him is what motivates us.</p>

            <p>Thank you for loving us, and believing in this ministry. Together we are fulfilling his commission: “Go
                into all the world and preach the gospel to every creature.” Mark 16:15</p>

            <p>We pray for the Lord to continue to bless you, and for Jesus to be glorified through your life!</p>

            <p>Andres, Giannina, Elijah, Anabella and James Bisonni <br><a href="www.holyspirit.tv">www.holyspirit.tv</a></p>
        @endif


        @if(app()->getLocale() == 'es')
            <b>Querido Patrocinador,</b><br><br>
            <p>Hemos creado una nueva página web del ministerio, y queríamos darle acceso a la nueva interface para
                patrocinadores. Desde este lugar va a poder leer el libro “Mi Amado Espiritu Santo” y también va a poder
                ver los mensajes desde diferentes conferencias. Creemos que el llamado a compartir el evangelio es
                urgente y tiene una importancia eterna. Es nuestro deseo el compartir el evangelio con amor y poder, y
                representar a Jesús con integridad y excelencia. Su amor por nosotros y nuestro amor por el es lo que
                nos motiva.</p>
            <p>Gracias por amarnos y por creer en este ministerio. Juntos estamos cumpliendo la gran comisión que nos
                dio el Señor: "Id por todo el mundo y predicad el evangelio a toda criatura.” Marcos 16:15</p>
            <p>Oramos para que el Señor Jesús siga siendo glorificado por medio de su vida!</p>
            <p>Andres, Giannina, Elijah, Anabella y James Bisonni <br><a href="https://www.espiritusanto.com">https://www.espiritusanto.com</a></p>
        @endif

    </div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="card-title text-blue">{{ __('auth.reset_password') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.email_address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.password') }}</label>

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
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('auth.confirm_password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('auth.reset_password_btn') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

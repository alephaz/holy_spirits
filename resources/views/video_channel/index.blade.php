@extends('layouts.app')

@section('title', $channel->title )

@section('content')
    @if((isset($videos) && !empty($videos)) && (!isset($login_form) || !$login_form))
        @foreach($videos as $video)
            @if($video->vimeo_link)
                <div class="card card-video mb-5">
                    <div class="card-body">
                        <div class="card-video">
                            {!! $video->vimeo_link !!}
                        </div>
                    </div>
                    <div class="card-footer">
                        <h3 class="card-title my-3">{{ $video->title }}</h3>
                    </div>
                </div>
            @else
                @if($loop->index <= 4)
                    <video-block :video="{{ $video->videoJson() }}"
                                 :agent="{{ json_encode([
                        'isTablet' => $agent->isTablet(),
                        'isPhone' => $agent->isPhone()
                    ]) }}"
                                 :sharing="{{ ($channel->roles && $channel->roles->count() ? 0 : 1) }}"></video-block>
                @endif
            @endif
        @endforeach
        <video-anchor :agent="{{ json_encode([
                        'isTablet' => $agent->isTablet(),
                        'isPhone' => $agent->isPhone()
                    ]) }}"
                      :sharing="{{ ($channel->roles && $channel->roles->count() ? 0 : 1) }}"></video-anchor>
    @endif

    {{--Show login for with message--}}
    @if(isset($login_form) && $login_form)
        <din class="container">
            <div class="col">
                @if(app()->getLocale() === 'en')
                    <p>
                        In appreciation for their support we make the full teachings from conferences and events
                        available to our partners.
                        For more information on how you may partner with the ministry simply click <a
                                class="btn btn-default" href="/partnership">here</a>
                    </p>
                @endif

                @if(app()->getLocale() === 'es')
                    <p>
                        En agradecimiento a su apoyo, las eneñanzas completas de diferentes conferencias y eventos de
                        jóvenes están disponible para nuestros patrocinadores. Para mas información puede hacer click
                        aquí <a
                                class="btn btn-default" href="/partnership">PATROCINE EL MINISTERIO</a>
                    </p>
                @endif
                
                 @if(app()->getLocale() === 'iw')
                    <p>
                        כהערכה על תמיכתם אנו מעמידים לרשות השותפים שלנו את מלוא ההוראה מכנסים ואירועים.
                        למידע נוסף על האופן שבו תוכלו לשתף פעולה עם המשרד פשוט לחצו<a
                                class="btn btn-default" href="/partnership">כאן</a>
                    </p>
                @endif
            </div>
        </din>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title text-blue">{{ __('Login') }}</h3></div>

                        <div class="card-body">
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
    @endif
@endsection
@push('scripts')
    @if((isset($videos) && !empty($videos)) && (!isset($login_form) || !$login_form))
        <script>
            window.videoList = [
                @foreach($videos as $video)
                @if($loop->index > 4 && !$video->vimeo_link)
                {!! $video->videoJson() !!}{{ !$loop->last ? ',' : '' }}
                @endif
                @endforeach
            ];
        </script>
    @endif
@endpush
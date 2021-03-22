@extends('layouts.app')

@section('title', 'Password reset')

@section('content')
    <div class="inner-page">
        <h1 class="text-blue">{{ __('profile.greeting') }} {{ auth()->user()->name }}!</h1>
        <div class="page-content">
            <div class="row">
                <div class="col">
                    <div class="card my-3">
                        <div class="card-header">
                            <h3 class="card-title text-blue ">{{ __('common.label_password_reset') }}</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">

                                <form class="row" method="post" action="{{ route('profile.password-save', $user->id) }}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('auth.password') }}</label>
                                            <input type="password"
                                                   name="password"
                                                   class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   id="password"
                                                   required autocomplete="false">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $errors->first('password') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('auth.confirm_password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="col-md-6 pt-4">
                                        <div class="form-group">
                                            <a class="btn btn-primary btn-width-equal" href="/profile">
                                                {{ __('common.label_back_button') }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-6 text-right pt-4">
                                        <div class="form-group">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-width-equal">
                                                {{ __('common.label_save_button') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

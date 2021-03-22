@extends('layouts.app')

@if($form =='prayer_request')
    @section('title', __('common.prayer_request_block_title'))
@endif

@if($form =='testimony')
    @section('title', __('common.testimony_block_title'))
@endif

@if($form =='contact_request')
    @section('title', __('common.contact_request_block_title'))
@endif

@section('content')

    <div class="inner-page">
        @if(session()->has('prayer_request_success'))
            <div class="alert alert-success">
                {{ session()->get('prayer_request_success') }}
            </div>
        @endif
        <h1 class="text-blue">
            @if($form =='prayer_request')
                {{ __('common.prayer_request_block_title') }}
            @endif

            @if($form =='testimony')
                {{ __('common.testimony_block_title') }}
            @endif

            @if($form =='contact_request')
                {{ __('common.contact_request_block_title') }}
            @endif
        </h1>
        <form class="row" method="post" action="{{ route('save-request', [$form, request()->route()->getName(), 0]) }}">
            <input type="hidden" name="recaptcha" id="recaptcha">
            @csrf
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">{{ __('common.label_your_name') }}</label>
                    <input type="text"
                           name="name"
                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                           id="name"
                           aria-describedby="emailHelp"
                           required
                           value="{{ old('name') }}"
                           placeholder="{{ __('common.label_your_name') }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $errors->first('name') }}</small>
                                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">{{ __('common.label_your_email') }}</label>
                    <input type="email"
                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                           id="email"
                           name="email"
                           aria-describedby="emailHelp"
                           required
                           value="{{ old('email') }}"
                           placeholder="{{ __('common.label_your_email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $errors->first('email') }}</small>
                                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="prayer-request">
                        @if($form =='prayer_request')
                            {{ __('common.prayer_request_block_message') }}
                        @endif

                        @if($form =='testimony')
                            {{ __('common.testimony_block_title') }}
                        @endif

                        @if($form =='contact_request')
                            {{ __('common.contact_request_block_message') }}
                        @endif
                    </label>
                    <textarea class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}"
                              name="message" required>{{ old('message') }}</textarea>
                    @if ($errors->has('message'))
                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $errors->first('message') }}</small>
                                        </span>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="prayer-request">
                        Captcha
                    </label>
                    <div class="row">
                        <div class="col-md-3">
                            @captcha
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="captcha" name="captcha" required class="form-control {{ $errors->has('captcha') ? ' is-invalid' : '' }}">
                            @if ($errors->has('captcha'))
                                <span class="invalid-feedback" role="alert">
                                            <small>{{ $errors->first('captcha') }}</small>
                                        </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           name="newsletter_subscription" id="latestVideos" checked>
                    <label class="form-check-label" for="Check1">
                        {{ __('common.receive_latest_videos') }}
                    </label>
                </div>
            </div>


            @if($form =='prayer_request')
                <input type="hidden" name="request_type" value="prayer_request"/>
            @endif

            @if($form =='testimony')
                <input type="hidden" name="request_type" value="testimony"/>
            @endif

            @if($form =='contact_request')
                <input type="hidden" name="request_type" value="contact_request"/>
            @endif

            <div class="col-md-6 text-right">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-width-equal">
                        {{ __('common.send_btn_text') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.sitekey') }}"></script>
<script>
         grecaptcha.ready(function() {
             grecaptcha.execute('{{ config('services.recaptcha.sitekey') }}', {action: 'contact'}).then(function(token) {
                if (token) {
                  document.getElementById('recaptcha').value = token;
                }
             });
         });
</script>
@endsection

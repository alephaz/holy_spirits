@extends('layouts.app')

@if(app()->getLocale() === 'en')
    @section('title', 'We invite you to watch this video on the Holy Spirit outpouring in the nations')
@endif

@if(app()->getLocale() === 'es')
    @section('title', 'Te invitamos a ver este video del Espiritu Santo siendo derramado en las naciones')
@endif

@if(app()->getLocale() === 'iw')
    @section('title', 'אנו מזמינים אתכם לצפות בסרטון זה על רוח הקודש המשתפכת באומות')
@endif

@section('content')
    @if(isset($videos) && !empty($videos))
        @foreach($videos as $video)
            @if($loop->index <= 2)
                @if($loop->first)
                   
                     <video-block :video="{{ $video->videoJson() }}"
                                 :agent="{{ \GuzzleHttp\json_encode([
                        'isTablet' => $agent->isTablet(),
                        'isPhone' => $agent->isPhone()
                    ]) }}"
                                 :sharing="1"></video-block>
                                 
                     @if(!$agent->isDesktop())
                    <div style="width: 100%;text-align: center;margin: -25px 0 25px 0;">
                        <a target="_blank" href="https://www.facebook.com/andresabm"><img style="width:100%;" src="/img/fb-follow.jpeg"></a>
                        <!--<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fandresabm%2F&tabs&width=340&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=633019620073376" width="340" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>   -->
                        </div>
                    @endif    
                        
                    @if(!$agent->isTablet())
                        <div class="card card-left-border card-border-blue desktop-mb-5">
                            <div class="card-header pb-0">
                                <h3 class="card-title text-blue">{{ __('common.prayer_request_block_title') }}</h3>
                            </div>
                            <div class="card-body py-0">
                                @if(session()->has('prayer_request_success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('prayer_request_success') }}
                                    </div>
                                @endif
                                <form class="row" method="post"
                                      action="{{ route('save-request', ['prayer_request', 'home', 0]) }}">
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
                                            <label for="prayer-request">{{ __('common.prayer_request_block_message') }}</label>
                                            <textarea
                                                    class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                    name="message" placeholder="Prayer Request or Testimony"
                                                    required>{{ old('message') ? old('message') : '' }}</textarea>
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
                                                <div class="col-md-3 ml-3">
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
                                            <label class="form-check-label"
                                                   for="Check1">{{ __('common.receive_latest_videos') }}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 text-right">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-width-equal">
                                                {{ __('common.send_btn_text') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
                            </div>
                        </div>
                    @endif
                    @if($agent->isTablet()||$agent->isPhone())
                        @if($agent->isTablet())
                            <div class="card card-left-border card-border-blue mb-3 email-subscribe">
                                <div class="card-header pb-0">
                                    <h3 class="card-title text-blue ">{{ __('common.subscribe_block_title') }}</h3>
                                </div>
                                <div class="card-body py-0">
                                    <p>{{ __('common.subscribe_block_text') }}</p>

                                    @if(session()->has('news_letter_success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('news_letter_success') }}
                                        </div>
                                        <script type="text/javascript">
                                            window.hideNewsletterSubscribe = true;
                                        </script>
                                    @endif

                                    <form class="row" method="post" action="{{ route('newsletter-subscribe') }}">
                                        @csrf
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="InputEmail1">{{ __('common.subscribe_block_email') }}</label>
                                                <input name="newsletter_email"
                                                       class="form-control {{ $errors->has('newsletter_email') ? ' is-invalid' : '' }}"
                                                       id="InputEmail1" aria-describedby="emailHelp"
                                                       type="email" required
                                                       placeholder="{{ __('common.subscribe_block_email') }}">
                                                @if ($errors->has('newsletter_email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <small>{{ $errors->first('newsletter_email') }}</small>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-width-equal">
                                                    {{ __('common.subscribe_block_button') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <div class="card card-left-border card-border-blue desktop-mb-5">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-md-2 col-5 p-0 mt-2">
                                       <!-- <img src="/img/book.png" class="img-fluid"> -->
                                                      @if(app()->getLocale() == 'iw')
                <img src="/img/iw-right-image2.jpeg" class="img-fluid">
                @else
                <img src="/img/book.png" class="img-fluid">
                @endif
                                    </div>
                                    <div class="col-md-10 col-7">
                                        <h3 class="card-title text-blue mt-3">{{ __('common.new_book_block_title') }}</h3>
                                        <p>{{ __('common.new_book_block_text') }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group text-right">
                                            <a href="/page/new-book" class="btn btn-primary btn-width-equal">
                                                {{ __('common.new_book_block_button') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($agent->isTablet())
                            <div class="card card-left-border card-border-blue desktop-mb-5">
                                <div class="card-header pb-0">
                                    <h3 class="card-title text-blue">{{ __('common.prayer_request_block_title') }}</h3>
                                </div>
                                <div class="card-body py-0">
                                    @if(session()->has('prayer_request_success'))
                                        <div class="alert alert-success">
                                            {{ session()->get('prayer_request_success') }}
                                        </div>
                                    @endif
                                    <form class="row" method="post"
                                          action="{{ route('save-request', ['prayer_request', 'home', 0]) }}">
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
                                                <label for="prayer-request">{{ __('common.prayer_request_block_message') }}</label>
                                                <textarea
                                                        class="form-control {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                                        name="message"
                                                        placeholder="{{ __('common.prayer_request_block_message') }}"
                                                        required></textarea>
                                                @if ($errors->has('message'))
                                                    <span class="invalid-feedback" role="alert">
                                            <small>{{ $errors->first('message') }}</small>
                                        </span>
                                                @endif
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
                                        <div class="col-md-6 text-right">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-width-equal">
                                                    {{ __('common.send_btn_text') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <div class="card card-left-border card-border-blue mb-4">
                            <div class="card-body py-0 px-3">
                                <div class="row">
                                    <div class="col-md-2 col-5 p-0">
                                        <img src="/img/donate.png" class="img-fluid">
                                    </div>
                                    <div class="col-md-10 col-7">
                                        <h6 class="my-2 font-weight-bold py-3">
                                            {{ __('common.donate_block_text') }}
                                        </h6>
                                        <div class="form-group text-right">
                                            {{--<div class="form-group text-right">--}}
                                            {{--<a href="/page/donations" class="btn btn-primary btn-width-equal text-red btn-light-blue mt-2 btn-donate">--}}
                                            {{--<i class="fas fa-heart"></i> Donate--}}
                                            {{--</a>--}}
                                            {{--</div>--}}
                                            @if(app()->getLocale() == 'en')
                                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post"
                                                      target="_top">
                                                    <input type="hidden" name="cmd" value="_s-xclick"/>
                                                    <input type="hidden" name="hosted_button_id" value="EZ2B2C9PKWA6E"/>
                                                    <input type="image"
                                                           src="{{ asset('/img/paypal-btns/Donate.jpg') }}"
                                                           border="0" name="submit"
                                                           title="PayPal - The safer, easier way to pay online!"
                                                           alt="Donate with PayPal button"/>
                                                    <img alt="" border="0"
                                                         src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1"
                                                         height="1"/>
                                                </form>
                                            @endif

                                            @if(app()->getLocale() == 'es')
                                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post"
                                                      target="_top">
                                                    <input type="hidden" name="cmd" value="_s-xclick"/>
                                                    <input type="hidden" name="hosted_button_id" value="P76593LVR57XE"/>
                                                    <input type="image"
                                                           src="{{ asset('/img/paypal-btns/Donar.jpg') }}"
                                                           border="0" name="submit"
                                                           title="PayPal - The safer, easier way to pay online!"
                                                           alt="Donate with PayPal button"/>
                                                    <img alt="" border="0"
                                                         src="https://www.paypal.com/es_US/i/scr/pixel.gif" width="1"
                                                         height="1"/>
                                                </form>
                                            @endif
                                            
                                            @if(app()->getLocale() == 'iw')
                                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post"
                                                      target="_top">
                                                    <input type="hidden" name="cmd" value="_s-xclick"/>
                                                    <input type="hidden" name="hosted_button_id" value="P76593LVR57XE"/>
                                                    <input type="image"
                                                           src="{{ asset('/img/paypal-btns/hebrew_donar.jpg') }}"
                                                           border="0" name="submit"
                                                           title="PayPal - The safer, easier way to pay online!"
                                                           alt="Donate with PayPal button"/>
                                                    <img alt="" border="0"
                                                         src="https://www.paypal.com/es_US/i/scr/pixel.gif" width="1"
                                                         height="1"/>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <video-block :video="{{ $video->videoJson() }}"
                                 :agent="{{ json_encode([
                        'isTablet' => $agent->isTablet(),
                        'isPhone' => $agent->isPhone()
                    ]) }}" :sharing="1"></video-block>
                @endif
            @endif
        @endforeach
        <video-anchor :agent="{{ json_encode([
                        'isTablet' => $agent->isTablet(),
                        'isPhone' => $agent->isPhone()
                    ]) }}" :sharing="1"></video-anchor>
    @endif
@endsection

@push('scripts')
    <script>
        window.videoList = [
            @if(isset($videos) && !empty($videos))
            @foreach($videos as $video)
            @if($loop->index > 2)
            {!! $video->videoJson() !!}{{ !$loop->last ? ',' : '' }}
            @endif
            @endforeach
            @endif
        ];
    </script>
@endpush

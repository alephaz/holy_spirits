<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(app()->getLocale() === 'en')
            @yield('title') - Andres Bisonni Ministries
        @endif

        @if(app()->getLocale() === 'es')
            @yield('title') - Andres Bisonni Ministerios
        @endif
        
        @if(app()->getLocale() === 'iw')
            @yield('title') - אנדרס וג'יאנינה ביזוני
        @endif
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="/fevicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/fevicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/fevicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/fevicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/fevicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/fevicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/fevicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/fevicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/fevicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/fevicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/fevicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/fevicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/fevicon/favicon-16x16.png">
    <link rel="manifest" href="/fevicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/fevicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
          integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <script type="text/javascript">
        window.HolySpirit = {
            language: "{{ $language }}",
            googleTranslateLoaded: false
        };
    </script>
</head>
<body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
@if(app()->getLocale() === 'en')
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endif

@if(app()->getLocale() === 'es')
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endif

@if(app()->getLocale() === 'iw')
    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/iw_IW/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endif

<script>window.twttr = (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function (f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));</script>
<div id="app">
    <div class="align-self-start sticky-top top-nav">
        <nav class="navbar navbar-expand-lg navbar-light navbar-laravel nav-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <div style="background-image: url('/svg/logo.svg');" class="logo float-left pr-2"></div>
                    @if(app()->getLocale() === 'en')
                        <div class="logo-text">ANDRES BISONNI <br>MINISTRIES</div>
                    @endif

                    @if(app()->getLocale() === 'es')
                        <div class="logo-text">ANDRES BISONNI <br>MINISTERIOS</div>
                    @endif
                    
                    @if(app()->getLocale() === 'iw')
                        <div class="logo-text" style="font-size: 25px;">אנדרס ביסוני
 <br>משרדים</div>
                    @endif
                </a>
                @if($agent->isMobile())
                    <ul class="navbar-nav d-lg-none d-xl-block">
                        <li class="nav-item">
                            <a href="/partnership"
                               class="nav-link ml-3 btn btn-secondary btn-yellow mr-0 text-blue btn-width-equal btn-partner">
                                <i class="fas fa-handshake"></i> {{ __('common.partner_with_us_text') }}</a>
                        </li>
                    </ul>
                @endif
                <div class="collapse navbar-collapse navbarSupportedContent" id="">
                    <button class="navbar-toggler navbar-close float-right p-3"
                            type="button" data-toggle="collapse"
                            data-target=".navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}">
                        <i class="fas fa-times"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        @if(isset($menu) && !empty($menu))
                            @foreach($menu as $parent_menu_item)
                                @if(empty($parent_menu_item['children']))
                                    <li class="nav-item {{ Request::is(str_replace('/', '', $parent_menu_item['slug'])) ? 'active' : '' }}">
                                        <a class="nav-link"
                                           href="{{ $parent_menu_item['slug'] }}">
                                            {{ $parent_menu_item['title']  }}
                                            @if(Request::is(str_replace('/', '', $parent_menu_item['slug'])))
                                                <span class="sr-only">(current)</span>
                                            @endif
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item dropdown {{ Request::is(str_replace('/', '', $parent_menu_item['slug'])) ? 'active' : '' }}">
                                        <a id="dropdownMainMenu{{ $loop->index }}"
                                           class="nav-link dropdown-toggle" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ $parent_menu_item['title']  }} <span class="caret"></span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMainMenu{{ $loop->index }}">
                                            @foreach($parent_menu_item['children'] as $child_menu)

                                                @if($child_menu['slug'] === '/page/audio' && Auth::user())
                                                    <a class="dropdown-item {{ Request::is(str_replace('/', '', $parent_menu_item['slug'])) ? 'active' : '' }}"
                                                       href="/channel/audio">
                                                        {{ $child_menu['title']  }}
                                                    </a>
                                                @else
                                                    <a class="dropdown-item {{ Request::is(str_replace('/', '', $parent_menu_item['slug'])) ? 'active' : '' }}"
                                                       href="{{ $child_menu['slug'] }}">
                                                        {{ $child_menu['title']  }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            {{--<li class="nav-item">--}}
                            {{--@if (Route::has('register'))--}}
                            {{--<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                            {{--@endif--}}
                            {{--</li>--}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ str_limit(Auth::user()->name, 8, false) }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @auth
                                        <a class="dropdown-item"
                                           href="/profile">
                                            {{ __('profile.profile') }}
                                        </a>
                                    @endauth
                                    @if($user && $user->can('viewAdministration'))
                                        <a class="dropdown-item"
                                           href="/admin">
                                            {{ __('Administration') }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    @if($agent->isPhone())
                        @if(isset($channels))
                            <ul class="navbar-nav ">
                                <li class="nav-item dropdown">
                                    <a id="dropdownMainMenu4" class="nav-link dropdown-toggle" href="#" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if(app()->getLocale() === 'en')
                                            Channels
                                        @endif

                                        @if(app()->getLocale() === 'es')
                                            Canales
                                        @endif
                                        
                                        @if(app()->getLocale() === 'iw')
                                            ערוצים
                                        @endif
                                        
                                        <span class="caret"></span></a>
                                    <div class="dropdown-menu">
                                        @foreach($channels as $channel)
                                            @if($channel->display_in_menu)
                                                @if($loop->index <= 7)
                                                    @if($channel->slug == "latest")
                                                        <a class="dropdown-item" href="/page/latest">
                                                            {{ $channel->title }}
                                                        </a>
                                                    @else
                                                        <a href="{{ route('channel.show', $channel->slug) }}"
                                                           class="dropdown-item {{ Request::is(str_replace('/', '', $channel->slug)) ? 'active' : '' }}">
                                                            {{ $channel->title }}
                                                        </a>
                                                    @endif
                                                @endif
                                            @endif
                                        @endforeach
                                        @if(count($channels) >= 7)
                                            <div class="dropdown">
                                                <button class="nav-link btn btn-secondary dropdown-toggle btn-bg-none d-none d-lg-block"
                                                        type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false">
                                                    More
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @foreach($channels as $channel)
                                                        @if($channel->display_in_menu)
                                                            @if($loop->index > 7)
                                                                <a class="dropdown-item"
                                                                   href="{{ route('channel.show', $channel->slug) }}">
                                                                    {{ $channel->title }}
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            </ul>

                        @endif
                        <ul class="navbar-nav ">
                            <li class="nav-item d-none d-lg-block">
                                @if(app()->getLocale() == 'en')
                                    <div class="fb-share-button"
                                         data-href="http://www.holyspirit.tv"
                                         data-layout="button_count">
                                    </div>
                                @endif

                                @if(app()->getLocale() == 'es')
                                    <div class="fb-share-button"
                                         data-href="http://www.espiritusanto.com"
                                         data-layout="button_count">
                                    </div>
                                @endif
                                
                                @if(app()->getLocale() == 'iw')
                                    <div class="fb-share-button"
                                         data-href="http://www.ruachadonai.tv"
                                         data-layout="button_count">
                                    </div>
                                @endif
                            </li>
                            <li class="nav-item ml-2 d-none d-lg-block twitter-follow">
                                <a class="twitter-share-button"
                                   href="https://twitter.com/intent/tweet">
                                    @if(app()->getLocale() == 'en')
                                        Tweet
                                    @endif

                                    @if(app()->getLocale() == 'es')
                                        Segulr
                                    @endif
                                    
                                    @if(app()->getLocale() == 'es')
                                        סגולר
                                    @endif
                                </a>
                            </li>
                        </ul>
                    @endif
                    <ul class="navbar-nav border-left pl-2">
                        <li class="nav-item">
                            <div class="dropdown">
                                @foreach($languages as $lang_code => $lang_lable)
                                    @if($lang_code === $language)
                                        <button class="nav-link btn btn-secondary dropdown-toggle btn-bg-none"
                                                type="button"
                                                id="dropdownLanguageMenu" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            {{ $lang_lable }}
                                        </button>
                                    @endif
                                @endforeach
                                <div class="dropdown-menu language-list" aria-labelledby="dropdownLanguageMenu"
                                     style="max-height: 200px; overflow: scroll; overflow-x: hidden;">
                                    @foreach($languages as $lang_code => $lang_label)
                                        @if($lang_code != $language)
                                            <a class="dropdown-item clear-google-translate"
                                               href="{{ route('language.switch', $lang_code) }}">{{ $lang_label }}</a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="/partnership"
                               class="nav-link ml-3 btn btn-secondary btn-yellow-new mr-0 text-blue btn-width-equal">
                                <i class="fas fa-handshake"></i> {{ __('common.partner_with_us_text') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @if(isset($channels))
            <nav class="navbar navbar-expand-lg navbar-light navbar-laravel nav-secondary">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target=".navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="container">
                    <ul class="navbar-nav social-links">
                        <!-- ::FACEBOOK Share Count ::-->
                        <!-- <li class="nav-item">
                            <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fandresabm&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;font=tahoma&amp;colorscheme=light&amp;action=like&amp;height=21&amp;appId=167212993290720"
                                    scrolling="no" frameborder="0"
                                    style="border:none; overflow:hidden; width:78px; height:20px;"
                                    allowTransparency="true"></iframe>
                        </li> -->
                        <li class="nav-item">
                            <div class="ml-2">
                                <a href="https://twitter.com/andresabm" class="twitter-follow-button"
                                   data-show-count="false" data-show-screen-name="false">Follow @andresabm</a>
                            </div>
                        </li>
                        <li class="nav-item social-instagram">
                            <a class="nav-link ml-2 text-white btn btn-primary btn-sm btn-ig"
                               href="https://www.instagram.com/andresbisonni/" target="_blank"><i
                                        class="fab fa-instagram"></i> Follow</a>
                        </li>
                        <li class="nav-item social-youtube">
                            <a class="nav-link ml-2 text-white btn btn-primary btn-sm btn-yt"
                               href="https://www.youtube.com/channel/UChIdLlwVNwTwF2lswUnIhJg?sub_confirmation=1"
                               target="_blank"><i
                                        class="fab fa-youtube"></i>
                                @if(app()->getLocale() == 'en')
                                    Subscribe
                                @endif

                                @if(app()->getLocale() == 'es')
                                    Suscribirse
                                @endif
                                
                                @if(app()->getLocale() == 'iw')
                                    הירשם כמנוי
                                @endif
                            </a>
                        </li>
                    </ul>
                    @if(!$agent->isPhone())
                        <ul class="navbar-nav channel-links ml-auto mr-4 ">
                            @foreach($channels as $channel)
                                @if($channel->display_in_menu)
                                    @if($loop->index <= 8)
                                        @if($channel->slug == "latest")
                                            <li class="nav-item">
                                                <a href="/page/latest" class="nav-link">
                                                    {{ $channel->title }}
                                                </a>
                                            </li>
                                        @else
                                            <li class="nav-item {{ strstr(request()->url(), $channel->slug) ? 'active' : '' }}">
                                                <a href="{{ route('channel.show', $channel->slug) }}" class="nav-link">
                                                    {{ $channel->title }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                            @if(count($channels) > 8)
                                <div class="dropdown">
                                    <button class="nav-link btn btn-secondary dropdown-toggle btn-bg-none d-none d-lg-block"
                                            type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        More
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach($channels as $channel)
                                            @if($channel->display_in_menu)
                                                @if($loop->index > 8)
                                                    <a class="dropdown-item"
                                                       href="{{ route('channel.show', $channel->slug) }}">
                                                        {{ $channel->title }}
                                                    </a>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </ul>
                        <ul class="navbar-nav social-links-2">
                            <li class="nav-item d-none d-lg-block">
                                @if(app()->getLocale() == 'en')
                                    <div class="fb-share-button"
                                         data-href="http://www.holyspirit.tv"
                                         data-layout="button_count">
                                    </div>
                                @endif

                                @if(app()->getLocale() == 'es')
                                    <div class="fb-share-button"
                                         data-href="http://www.espiritusanto.com"
                                         data-layout="button_count">
                                    </div>
                                @endif
                                
                                @if(app()->getLocale() == 'iw')
                                    <div class="fb-share-button"
                                         data-href="http://www.ruachadonai.tv"
                                         data-layout="button_count">
                                    </div>
                                @endif
                            </li>
                            <li class="nav-item ml-2 d-none d-lg-block twitter-follow">
                                <a class="twitter-share-button"
                                   href="https://twitter.com/intent/tweet">
                                    @if(app()->getLocale() == 'en')
                                        Tweet
                                    @endif

                                    @if(app()->getLocale() == 'es')
                                        Segulr
                                    @endif
                                    
                                    @if(app()->getLocale() == 'iw')
                                        סגולר
                                    @endif
                                    
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>
            </nav>
        @endif
    </div>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-lg-{{ ($agent->isMobile() ? '12' : '8') }} col-md-12">
                    @yield('content')
                </div>
                @if(!$agent->isTablet() && !$agent->isPhone())
                    <aside class="col-lg-4 col-md-12 align-self-start sticky-top">
                        @include('layouts.right_column')
                    </aside>
                @else
                    @if($agent->isPhone())
                        <div class="card mb-3 email-subscribe show mobile-view hidden"
                             id="email-subscribe">
                            <a class="close" data-toggle="collapse" href="#email-subscribe" role="button"
                               aria-expanded="false"
                               aria-controls="email-subscribe">
                                <span aria-hidden="true">&times;</span>
                            </a>
                            <div class="card-body py-0">
                                @if(session()->has('news_letter_success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('news_letter_success') }}
                                    </div>
                                    <script type="text/javascript">
                                        window.hideNewsletterSubscribe = true;
                                    </script>
                                @else
                                    <form class="row" method="post" action="{{ route('newsletter-subscribe') }}">
                                        @csrf
                                        <div class="col-md-12 form-inline">
                                            <div class="form-group mr-3 mb-2">
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
                                            <button type="submit" class="btn btn-primary mb-2">
                                                {{ __('common.subscribe_block_title') }}
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </main>
    <footer class="mt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col text-center my-2">
                    <div id="google_translate_element"></div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center my-3 mb-4">
                    @if(app()->getLocale() === 'en')
                        <span><a href="/privacy-policy">Privacy Policy</a> | </span>
                    @endif

                    @if(app()->getLocale() === 'es')
                        <span><a href="/privacy-policy">Política de privacidad</a> | </span>
                    @endif
                    <span class="copyright">Copyright © HolySpirit - Andres Bisonni Ministries</span>
                    <span class="solution-provider pull-right"> By
                        <a href="https://www.alephaz.com" target="_blank"> Aleph</a>
                    </span>
                </div>
            </div>
        </div>
    </footer>
</div>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        window.HolySpirit.googleTranslateLoaded = true;
    }
</script>
<script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript" defer>
    $(document).ready(function () {

        @if($agent->isMobile())
        if (window.hideNewsletterSubscribe) {
            Cookies.set('hideNewsletterSubscribe', true);
            setTimeout(function () {
                $('.email-subscribe').fadeOut();
            }, 3000);
        } else {
            if (Cookies.get('hideNewsletterSubscribe')) {
                $('.email-subscribe').hide();
            } else {
                $('.email-subscribe').show();
            }
        }

        $("a[href='#email-subscribe']").click(function () {
            Cookies.set('hideNewsletterSubscribe', true);
        });
                @endif

        var googleTranslateLoadTimer = setInterval(function () {
                if (window.HolySpirit.googleTranslateLoaded) {
                    if ($('.goog-te-combo option').length) {
                        clearInterval(googleTranslateLoadTimer);

                        $('.goog-te-combo option').each(function () {

                            var languageElement = $(this);

                            if (languageElement.val() && languageElement.val() != 'en' && languageElement.val() != 'es' && languageElement.val() != 'iw') {

                                var languageDropDownElement = $('<a href="#" class="dropdown-item" data-language-code="/{{ app()->getLocale()  }}/' + languageElement.val() + '">' + languageElement.html() + '</a>');

                                languageDropDownElement.click(function () {

                                    Cookies.set('googtrans', $(this).data('language-code'));

                                    location.reload();

                                });

                                $('.language-list').append(languageDropDownElement);
                            }
                        });

                        // update the active language if there is any
                        if (Cookies.get('googtrans')) {

                        }
                        
                        // check if the Hebrew site is loaded and reload with the cookie as Cookies.set('googtrans', '/en/iw');
                        // if(location.href.search('ruachadonai.tv') > -1 && Cookies.get('googtrans') != '/en/iw'){
                        //     Cookies.set('googtrans', '/en/iw');
                        //     location.reload();
                        // }
                        
                    }
                }
            }, 100);

        $('.clear-google-translate').click(function () {
            Cookies.remove('googtrans');
        });
    });
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131543910-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-131543910-2');
</script>
@stack('scripts')
<style>
.btn-yellow-new{
    background-color: #fa7129 !important;
    color: black !important;
}
.btn-yellow-new:hover{
    background-color: #ff9a49 !important;
}
</style>
</body>
</html>

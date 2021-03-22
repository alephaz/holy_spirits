@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="inner-page">
        <h1 class="text-blue">{{ __('profile.greeting') }} {{ auth()->user()->name }}!</h1>
        <div class="page-content">
            <div class="row">
                <div class="col">

                    @if(session()->has('profile_saved'))
                        <div class="alert alert-success">
                            {{ session()->get('profile_saved') }}
                        </div>
                    @endif

                    <div class="card my-3">
                        <div class="card-header">
                            <h3 class="card-title text-blue ">{{ __('profile.block_title') }}</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="py-1"><a href="{{ route('profile.edit', auth()->user()->id)  }}"><i
                                                class="fas fa-users"></i> {{ __('profile.edit_information') }}</a></li>
                                <li class="py-1"><a href="{{ route('profile.password-reset', auth()->user()->id)  }}"><i
                                                class="fas fa-key"></i> {{ __('profile.update_password') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @can('viewPaidContent')

                {{--                @if(isset($books) && count($books))--}}
                {{--                    <div class="row">--}}
                {{--                        <div class="col">--}}
                {{--                            @foreach($books as $book)--}}
                {{--                                <div class="card my-3">--}}
                {{--                                    <div class="card-header">--}}
                {{--                                        <h3 class="card-title text-blue ">{{ $book->title }}</h3>--}}
                {{--                                        <p>{{ $book->description }}</p>--}}
                {{--                                    </div>--}}
                {{--                                    <div class="card-body">--}}
                {{--                                        <p>--}}
                {{--                                            @if($book->data && $agent->isMobile())--}}
                {{--                                                <a href="/pdf/web/viewer.html?file={{ \Illuminate\Support\Facades\Storage::url($book->data) }}"--}}
                {{--                                                   target="_blank">--}}
                {{--                                                    @if($book->hasMedia('thumb_image'))--}}
                {{--                                                        @foreach($book->getMedia('thumb_image') as $image)--}}
                {{--                                                            <img src="{{ $image->getUrl() }}"--}}
                {{--                                                                 alt="{{ $book->title }}" class="featured"--}}
                {{--                                                                 style="max-width: 200px;">--}}
                {{--                                                        @endforeach--}}
                {{--                                                    @endif--}}
                {{--                                                </a>--}}
                {{--                                            @endif--}}

                {{--                                            @if($book->data && !$agent->isMobile())--}}
                {{--                                                <a href="/pdf/web/viewer.html?file={{ \Illuminate\Support\Facades\Storage::url($book->data) }}#magazineMode=true"--}}
                {{--                                                   target="_blank">--}}
                {{--                                                    @if($book->hasMedia('thumb_image'))--}}
                {{--                                                        @foreach($book->getMedia('thumb_image') as $image)--}}
                {{--                                                            <img src="{{ $image->getUrl() }}"--}}
                {{--                                                                 alt="{{ $book->title }}" class="featured"--}}
                {{--                                                                 style="max-width: 200px;">--}}
                {{--                                                        @endforeach--}}
                {{--                                                    @endif--}}
                {{--                                                </a>--}}
                {{--                                            @endif--}}
                {{--                                        </p>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            @endforeach--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                @endif--}}

                <div class="row">
                    <div class="col">
                        <div class="card my-3">
                            <div class="card-header">
                                <h3 class="card-title text-blue ">{{ __('profile.book_title') }}</h3>
                                <p>{{ __('profile.book_description') }}</p>
                            </div>
                            <div class="card-body">

                                @if(app()->getLocale() === 'en')
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/QfxrICexAkX91ujkOgYPT2nGOftD9vk5YIpuuuTH.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        English
                                    </a>
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/BSz4vvdc6MdyX78rVgipQEzYVCMtbzqHTMxEsRtL.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Spanish
                                    </a>
                               <!--     <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/MyBelovedHolySpiritArabic.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Arabic
                                    </a>
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/MyBelovedHolySpiritFRENCH.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        French
                                    </a>
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/IkfdNUbwK01k4CKId81rIZpN38xOm0kBxaA1fvJR.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Hebrew
                                    </a>
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/LibrocompletoAndresBisonni.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Italian
                                    </a> -->
                                @endif

                                @if(app()->getLocale() === 'es')
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/BSz4vvdc6MdyX78rVgipQEzYVCMtbzqHTMxEsRtL.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Español
                                    </a>
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/QfxrICexAkX91ujkOgYPT2nGOftD9vk5YIpuuuTH.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Inglés
                                    </a>
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/MyBelovedHolySpiritArabic.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Arábica
                                    </a>
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/MyBelovedHolySpiritFRENCH.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Francés
                                    </a>
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/IkfdNUbwK01k4CKId81rIZpN38xOm0kBxaA1fvJR.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Hebrew
                                    </a>
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/LibrocompletoAndresBisonni.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        Italian
                                    </a>
                                @endif
                                
                                @if(app()->getLocale() === 'iw')
                                    <a href="https://holyspirit.tv/pdf/web/viewer.html?file=/storage/IkfdNUbwK01k4CKId81rIZpN38xOm0kBxaA1fvJR.pdf#magazineMode=true"
                                       class="btn btn-default" target="_blank">
                                        עִברִית
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card my-3">
                            <div class="card-header">
                                <h3 class="card-title text-blue ">{{ __('profile.teachings_title') }}</h3>
                                <p>{{ __('profile.teachings_message') }}</p>
                            </div>
                            <div class="card-body">
                                <a href="/channel/teachings" class="btn btn-default">
                                    Video
                                </a>
                                @if(app()->getLocale() === 'en')
                                    <a href="/channel/audio" class="btn btn-default">
                                        Audio
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection

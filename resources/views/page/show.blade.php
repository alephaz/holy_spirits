@extends('layouts.app')

@section('title', $content->title. ' - HolySpirit')

@section('content')
    <div class="inner-page">
        <h1 class="text-blue">{{ $content->title }}</h1>
        <div class="page-content">
           
            @if($content->featured_image)
				@if($content->id === 3 && $content->slug ==='new-book' && app()->getLocale() === 'iw')
                <div class="img">
                    <img class="featured" src="/img/iw-right-image2.jpeg"
                         alt="{{ $content->title }}" style="max-width: 200px">
                </div>
				@else
					<div class="img">
                    <img class="featured" src="{{ asset('/storage/'.$content->featured_image) }}"
                         alt="{{ $content->title }}" style="max-width: 200px">
                </div>
				@endif
            @endif
            <p>&nbsp;</p>
            @if(app()->getLocale() === 'iw')
            <div style="width:100%;float: left; margin-top: 36px;">
             @if($content->id === 3)
                @if(session()->has('news_letter_success'))
                    <div class="alert alert-success">
                        {{ session()->get('news_letter_success') }}
                    </div>
                @endif
                <p>{{ __('common.receive_first_chapter_message') }}</p>
                <form class="row" method="post" action="{{ route('newsletter-subscribe') }}?redirect=page/new-book">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
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
                            <button type="submit"
                                    class="btn btn-primary btn-width-equal">{{ __('common.subscribe_block_button') }}</button>
                        </div>
                    </div>
                </form>
            @endif
            </div>
             @endif
              <p>&nbsp;</p>
            {!! $content->body !!}
<p>&nbsp;</p>
          
            @if(app()->getLocale() !== 'iw')
			@if($content->id === 3)
                @if(session()->has('news_letter_success'))
                    <div class="alert alert-success">
                        {{ session()->get('news_letter_success') }}
                    </div>
                @endif
                <p>{{ __('common.receive_first_chapter_message') }}</p>
                <form class="row" method="post" action="{{ route('newsletter-subscribe') }}?redirect=page/new-book">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
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
                            <button type="submit"
                                    class="btn btn-primary btn-width-equal">{{ __('common.subscribe_block_button') }}</button>
                        </div>
                    </div>
                </form>
            @endif
			@endif
        </div>
    </div>
@endsection

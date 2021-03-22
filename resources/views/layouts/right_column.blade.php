@if($agent->isDesktop())
<div class="card card-left-border card-border-blue mb-3">
    <div class="card-body py-0" style="padding: 0px 0px 0px 0px;margin: 8px 0px 0px 0px;text-align: center;">
    <a target="_blank" href="https://www.facebook.com/andresabm"><img style="width:100%;" src="/img/fb-follow.jpeg"></a>
    <!--<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fandresabm%2F&tabs&width=280&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=633019620073376" width="280" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe> -->
    </div>
</div>    
@endif


<div class="card card-left-border card-border-blue mb-3 email-subscribe hidden">
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
                    <button type="submit" class="btn btn-primary btn-width-equal">{{ __('common.subscribe_block_button') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card card-left-border card-border-blue mb-3">
    <div class="card-body py-0">
        <div class="row">
            <div class="col-md-3 col-lg-4 p-0 mt-2">
              @if(app()->getLocale() == 'iw')
                <img src="/img/iw-right-image2.jpeg" class="img-fluid">
                @else
                <img src="/img/book.png" class="img-fluid">
                @endif
            </div>
            <div class="col-8">
                <h3 class="card-title text-blue mt-3">{{ __('common.new_book_block_title') }}</h3>
                <p class="small-text">{{ __('common.new_book_block_text') }}</p>
            </div>
            <div class="col-md-12">
                <div class="form-group text-right">
                    <a href="/page/new-book" class="btn btn-primary btn-width-equal">{{ __('common.new_book_block_button') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card card-left-border card-border-blue mb-3">
    <div class="card-body py-0 px-3">
        <div class="row">
            <div class="col-md-3 col-lg-4 p-0">
                <img src="/img/donate.png" class="img-fluid">
            </div>
            <div class="col-8">
                <h6 class="my-2 font-weight-bold mt-3 ">{{ __('common.donate_block_text') }}</h6>
                <div class="form-group text-right mt-3 mb-0">
                    @if(app()->getLocale() == 'en')
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick" />
                            <input type="hidden" name="hosted_button_id" value="EZ2B2C9PKWA6E" />
                            <input type="image" src="{{ asset('/img/paypal-btns/Donate.jpg') }}" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
                        </form>
                    @endif

                    @if(app()->getLocale() == 'es')
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick" />
                            <input type="hidden" name="hosted_button_id" value="P76593LVR57XE" />
                            <input type="image" src="{{ asset('/img/paypal-btns/Donar.jpg') }}" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                            <img alt="" border="0" src="https://www.paypal.com/es_US/i/scr/pixel.gif" width="1" height="1" />
                        </form>
                    @endif
                    
                    @if(app()->getLocale() == 'iw')
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick" />
                            <input type="hidden" name="hosted_button_id" value="EZ2B2C9PKWA6E" />
                            <input type="image" src="{{ asset('/img/paypal-btns/hebrew_donar.jpg') }}" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                            <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

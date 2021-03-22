@extends('layouts.app')

@section('title', __('common.partnership_page_form_cc_monthly_contribution'))

@section('content')
    <div class="inner-page">
        <h1 class="text-blue">{{ __('common.partnership_page_form_cc_monthly_contribution') }}</h1>

        @if(request()->has('demo'))
            <div class="row">
                <div class="col alert alert-info">
                    <div class="alert alert-success text-capitalize">
                        THIS IS ONLY VISIBLE FOR ADMINISTRATORS
                    </div>
                    <h3>Sandbox button</h3>
                    <p>
                        Username : holyspirit@customer.com <br>
                        Password : hs123456
                    </p>
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

                        <input type="hidden"
                               name="business"
                               value="holyspirit@local.com">

                        <input type="hidden" name="cmd" value="_donations">

                        <input type="hidden" name="item_name" value="Andres Bisonni Ministries">

                        <input type="hidden" name="item_number" value="0.01 Donation">

                        <input type="hidden" name="custom"
                               value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">

                        <input type="hidden" name="amount" value="10">

                        <input type="hidden" name="currency_code" value="USD">

                        <!-- Display the payment button. -->
                        <input type="image" name="submit"
                               src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"
                               alt="Donate">
                        <img alt="" width="1" height="1"
                             src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
                    </form>

                    <h3>Actual 0.1$ Button</h3>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="B2MV2R9AAB9TW">
                        <input type="hidden" name="custom"
                               value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                        <input type="image" src="{{ asset('/img/paypal-btns/0.1.jpg') }}" border="0"
                               name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                             height="1">
                    </form>
                </div>
            </div>
        @endif
		
		

        <div class="row mt-5">

            @foreach([5, 10, 20, 30, 50, 100, 250] as $item)
                <div class="col-md-3">
                    <div class="mb-4 text-center">
						
						@if($item == 1)
								<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
									<input type="hidden" name="cmd" value="_s-xclick">
									<input type="hidden" name="hosted_button_id" value="B2MV2R9AAB9TW">
									<input type="hidden" name="custom"
										   value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
									<input type="image" src="{{ asset('/img/paypal-btns/0.1.jpg') }}" border="0"
										   name="submit" alt="PayPal - The safer, easier way to pay online!">
									<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
										 height="1">
								</form>
                        @endif

                        @if($item == 5)

                            @if(app()->getLocale() == 'en')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="8VV4Y4RDBSEBU">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/5.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                            @if(app()->getLocale() == 'es')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="HRRA2BXBJ4MQE">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/5.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif
                            
                             @if(app()->getLocale() == 'iw')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="HRRA2BXBJ4MQE">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/5.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                        @endif

                        @if($item == 10)

                            @if(app()->getLocale() == 'en')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="XBSMT7YP5V6LS">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/10.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                            @if(app()->getLocale() == 'es')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="STS3GARLM8KX6">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/10.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif
                            
                            @if(app()->getLocale() == 'iw')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="STS3GARLM8KX6">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/10.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                        @endif

                        @if($item == 20)

                            @if(app()->getLocale() == 'en')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="KZLM79NXTW952">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/20.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                            @if(app()->getLocale() == 'es')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="NF3Z6Y3TYEU6G">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/20.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif
                            
                            @if(app()->getLocale() == 'iw')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="NF3Z6Y3TYEU6G">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/20.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                        @endif

                        @if($item == 30)

                            @if(app()->getLocale() == 'en')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="2SHMMKWHZ9FB8">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/30.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                            @if(app()->getLocale() == 'es')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="2PVMDA6SB6ZUC">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/30.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif
                            
                            @if(app()->getLocale() == 'iw')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="2PVMDA6SB6ZUC">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/30.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                        @endif

                        @if($item == 50)

                            @if(app()->getLocale() == 'en')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="HFMVDEJJKX74J">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/50.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                            @if(app()->getLocale() == 'es')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="DJ86YL942P4MG">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/50.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif
                            
                            @if(app()->getLocale() == 'iw')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="DJ86YL942P4MG">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/50.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                        @endif

                        @if($item == 100)

                            @if(app()->getLocale() == 'en')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="S9UPX7X8Z33ZU">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/100.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                            @if(app()->getLocale() == 'es')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="KSJ2QYM4BW75C">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/100.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>

                            @endif
                            
                            @if(app()->getLocale() == 'iw')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="KSJ2QYM4BW75C">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/100.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>

                            @endif

                        @endif

                        @if($item == 250)

                            @if(app()->getLocale() == 'en')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="52CJVQEM9HKJU">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/250.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>
                            @endif

                            @if(app()->getLocale() == 'es')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="STDY8S4UJXQZY">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/250.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>

                            @endif
                            
                             @if(app()->getLocale() == 'iw')
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="STDY8S4UJXQZY">
                                    <input type="hidden" name="custom"
                                           value="{{ \GuzzleHttp\json_encode(['email' => $email, 'donation_id' => $donation_id, 'language' => app()->getLocale()]) }}">
                                    <input type="image" src="{{ asset('/img/paypal-btns/250.jpg') }}  "
                                           border="0" name="submit"
                                           alt="PayPal - The safer, easier way to pay online!">
                                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                                         width="1" height="1">
                                </form>

                            @endif
                            
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

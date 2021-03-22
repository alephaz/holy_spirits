@extends('layouts.app')

@section('title', 'Invitations')

@section('content')
    <div class="inner-page">

        @if(session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        <h1 class="text-blue">{{ __('common.invitations_page_title') }}</h1>
        @if(app()->getLocale() == 'en')
            <p>
                As a ministry we have a desire to see lives come to know Jesus Christ as their personal Lord and Savior,
                and at the same time, to see a great outpouring of the Holy Spirit upon the nations of the earth.
            </p>

            <p>We prayerfully consider invitations to go anywhere in the world to share the gospel in miracle crusades,
                conferences, youth events and church services.</p>
        @endif

        @if(app()->getLocale() == 'es')
            <p>Nuestro ministerio tiene el deseo de que muchas vidas alcancen a conocer a Jesucristo como su Señor y
                Salvador personal y, al mismo tiempo, de ver un gran avivamiento y derramamiento del Espíritu Santo
                sobre todas las naciones de la tierra.
                Todas las invitaciones que recibimos para ir a a compartir el Evangelio a cualquier parte del mundo, son
                tomadas seriamente y oramos buscando la dirección de Dios.
            </p>
            <p>
                Normalmente, realizamos cruzadas de milagros, conferencias del Espíritu Santo, eventos de jóvenes y
                reuniones especiales.
            </p>
        @endif
        
         @if(app()->getLocale() == 'iw')
            <p>
                כמשרד יש לנו רצון לראות את החיים מכירים את ישוע המשיח כאדונם ומושיעם האישי, ובאותה עת לראות שפיכה גדולה של רוח הקודש על אומות העולם.
            </p>

            <p>אנו שוקלים בתפילה הזמנות ללכת לכל מקום בעולם לחלוק את הבשורה במסעי צלב נס, כנסים, אירועי נוער ושירותי כנסיות.</p>
        @endif
        
        <h5>{{ __('common.invitations_page_description_2') }}</h5>
        <form method="post" action="{{ route('invitations.store') }}">
            <input type="hidden" name="recaptcha" id="recaptcha">
            @csrf
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_title') }}</label>
                <input name="name" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_title') }}"
                       required>
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_church_name') }}</label>
                <input name="church_name" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_church_name') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_email') }}</label>
                <input name="email" type="email" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_email') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_address') }}</label>
                <input name="address" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_address') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_city') }}</label>
                <input name="city" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_city') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_state') }}</label>
                <input name="state" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_state') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_zip_code') }}</label>
                <input name="zip_code" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_zip_code') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_country') }}</label>
                <input name="country" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_country') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_telephone') }}</label>
                <input name="telephone_phone" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_telephone') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_mobile_phone') }}</label>
                <input name="mobile_phone" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_mobile_phone') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_church_website') }}</label>
                <input name="website" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_church_website') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_type_event') }}</label>
                <input name="event_type" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_type_event') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_venue_capacity') }}</label>
                <input name="venue_capacity" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_venue_capacity') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_expected_attendance') }}</label>
                <input name="expected_attendance" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_expected_attendance') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_tentative_dates') }}</label>
                <input name="tentative_dates" type="text" class="form-control col-md-6"
                       placeholder="{{ __('common.invitations_page_form_tentative_dates') }}">
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_responses') }}</label>
                <textarea name="previous_event_details" class="form-control" rows="3"
                          placeholder="{{ __('common.invitations_page_form_responses') }}"></textarea>
            </div>
            <div class="form-group">
                <label for="">{{ __('common.invitations_page_form_message') }}</label>
                <textarea name="message" class="form-control" rows="3"
                          placeholder="{{ __('common.invitations_page_form_message') }}"></textarea>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input name="newsletter_subscription" type="checkbox" class="form-check-input" id="latestVideos"
                           checked="">
                    <label class="form-check-label"
                           for="exampleCheck1">{{ __('common.receive_latest_videos') }}</label>
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
            <button type="submit"
                    class="btn btn-primary btn-width-equal">{{ __('common.send_btn_text') }}</button>
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
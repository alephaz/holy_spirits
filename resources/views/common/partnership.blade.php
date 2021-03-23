@extends('layouts.app')

@section('title', __('common.partnership_title'))

@section('content')
    <div class="inner-page">
        <h1 class="text-blue">{{ __('common.partnership_title') }}</h1>
        <div class="row">
            <div class="col-md-12">
                @if(app()->getLocale() == 'en')
                    <p>With a contribution of $5 per month or more, you may partner with the ministry making it possible
                        for
                        us to continue to take the gospel of Jesus Christ in the power of the Holy Spirit to the
                        nations.</p>

                    <p>In appreciation for your support, you will have online access to the book “My Beloved Holy
                        Spirit”
                        written by Andres Bisonni, and to the complete teachings from different conferences and
                        crusades.
                        For those who live in the United States and sign up with a monthly contribution of $10 or more,
                        we
                        will also mail you a hard copy of the book. As a partner not only you will be receiving a copy of the book,
                        but you will also be making the book "My Beloved Holy Spirit" available in Hebrew as a free gift to the Jewish people.</p>

                    <p>We are a nonprofit organization, and upon request, we will also send you a tax deductible form at
                        the
                        end of the year.

                        It is our desire to see the Lord pour out His Spirit upon all people, and for entire nations to
                        come
                        to the knowledge of Jesus.

                        With your support we will be able to continue to fulfill this vision that began in the heart of
                        God!

                        If you would like to partner with the ministry, simply choose one of the options below:</p>
                @endif

                @if(app()->getLocale() == 'es')
                    <p>
                        Con una contribución de $5 dólares mensuales o mas, puedes patrocinar el ministerio y apoyarnos
                        para que podamos seguir llevando el Evangelio de Jesucristo en el poder del Espíritu Santo a las
                        naciones!
                    </p>
                    <p>
                        En agradecimiento a tu apoyo, tendrás acceso en línea al libro, “Mi Amado Espíritu Santo,” y a
                        las enseñanzas por completo en video de conferencias desde diferentes lugares del mundo. Para
                        los que viven en los Estados Unidos y se anotan como patrocinadores con una donación mensual de
                        $10 o mas, también les estaremos enviando por correo una copia del libro.
                    </p>
                    <p>
                        Somos una organización sin fines de lucro, y si lo solicitas, también te enviaremos un recibo de
                        tus donaciones a fin de año.
                        Es nuestra visión y mayor deseo ver al Señor derramar Su Espíritu sobre todas las personas, y
                        que naciones enteras lleguen al conocimiento de Jesús.
                    </p>
                    <p>
                        Con tu apoyo podremos seguir cumpliendo con esta visión que empezó en el corazón de Dios!
                        Si te gustaría patrocinar el ministerio, simplemente elige una de las opciones debajo:
                    </p>
                @endif

                @if(app()->getLocale() == 'iw')
                    <p>בתרומה של 5 דולר לחודש ומעלה, אתה יכול לשתף פעולה עם המשרד כדי לאפשר לנו להמשיך ולקבל את הבשורה של ישוע המשיח בכוח רוח הקודש לאומות.</p>

                    <p>כהערכה על תמיכתך, תהיה לך גישה מקוונת לספר "רוח הקודש האהובה שלי" שנכתב על ידי אנדרס ביסונני, ולשלבי השיחות של כנסים ומסעות צלב שונים.
לאלו שגרים בארצות הברית ונרשמים בתרומה חודשית של 10 דולר ומעלה, אנו נשלח אליכם גם עותק קשיח של הספר.</p>

                    <p>אנו ארגון ללא מטרות רווח, ועל פי בקשה, אנו נשלח אליך טופס השתתפות עצמית בסוף השנה. עבור מי שמתגורר בארצות הברית ונרשם בתרומה חודשית של 10 דולר ומעלה, נשלח גם בדואר לך עותק קשיח של הספר.

                        רצוננו לראות את האדון שופך את רוחו על כל האנשים, ולעמים שלמים יכירו את ישוע.


                        בתמיכתך נוכל להמשיך ולהגשים חזון זה שהחל בלב אלוהים!


                        אם ברצונך לשתף פעולה עם המשרד, בחר באחת מהאפשרויות שלהלן:</p>
                @endif

                @if(app()->getLocale() == 'it')
                <p>Con un contributo di $ 5 al mese o più, puoi collaborare con il ministero rendendoci possibile continuare a portare il vangelo di Gesù Cristo alle nazioni nella potenza dello Spirito Santo
                    È nostro desiderio vedere il Signore distribuire il Suo Spirito a tutti e che intere nazioni giungano alla conoscenza di Gesù. Con il tuo sostegno potremo continuare a realizzare questa visione iniziata nel cuore di Dio! Se desideri collaborare con il ministero, scegli semplicemente una delle opzioni seguenti:
                    .</p>

                <p>In appreciation for your support, you will have online access to the book “My Beloved Holy
                    Spirit”
                    written by Andres Bisonni, and to the complete teachings from different conferences and
                    crusades.
                    For those who live in the United States and sign up with a monthly contribution of $10 or more,
                    we
                    will also mail you a hard copy of the book. As a partner not only you will be receiving a copy of the book,
                    but you will also be making the book "My Beloved Holy Spirit" available in Hebrew as a free gift to the Jewish people.</p>

                <p>We are a nonprofit organization, and upon request, we will also send you a tax deductible form at
                    the
                    end of the year.

                    It is our desire to see the Lord pour out His Spirit upon all people, and for entire nations to
                    come
                    to the knowledge of Jesus.

                    With your support we will be able to continue to fulfill this vision that began in the heart of
                    God!

                    If you would like to partner with the ministry, simply choose one of the options below:</p>
            @endif

            </div>
        </div>

        @if(session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif

        <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
            <li class="nav-item mr-4 mb-3">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#tab1" role="tab">
                    {{ __('common.partnership_page_btn_bank') }}
                </a>
            </li>
            <li class="nav-item mb-3">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab2" role="tab">
                    {{ __('common.partnership_page_btn_cc') }}
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="tab1" role="tabpanel" aria-labelledby="home-tab">
                <form method="post" action="{{ route('donations.store') }}">
                    @csrf
                    <input type="hidden" name="paypal_donation" value="false">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_first_name') }}</label>
                                <input type="text" class="form-control col-md-12" name="name"
                                       placeholder="{{ __('common.partnership_page_form_first_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_last_name') }}</label>
                                <input type="text" class="form-control col-md-12" name="last_name"
                                       placeholder="{{ __('common.partnership_page_form_last_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_address') }}</label>
                                <input type="text" name="address" class="form-control col-md-10"
                                       placeholder="{{ __('common.partnership_page_form_address') }}"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_telephone') }}</label>
                                <input type="tel" name="telephone" class="form-control col-md-6"
                                       placeholder="{{ __('common.partnership_page_form_telephone') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_account_number') }}</label>
                                <input type="text" name="account_number" class="form-control col-md-6"
                                       placeholder="{{ __('common.partnership_page_form_account_number') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_monthly_contribution') }}</label>
                                <input type="number" name="monthly_contribution" class="form-control col-md-6"
                                       placeholder="$" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_email') }}</label>
                                <input type="email" name="email" class="form-control col-md-10"
                                       placeholder="{{ __('common.partnership_page_form_email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_city_state') }}</label>
                                <input type="text" name="city" class="form-control col-md-10 mb-2"
                                       placeholder="{{ __('common.invitations_page_form_city') }}">
                                <input type="text" name="state" class="form-control col-md-10 mb-2"
                                       placeholder="{{ __('common.invitations_page_form_state') }}">
                                <input type="text" name="zip_code" class="form-control col-md-10 mb-2"
                                       placeholder="{{ __('common.invitations_page_form_zip_code') }}">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_routing_number') }}</label>
                                <input type="text" name="routing_number" class="form-control col-md-10"
                                       placeholder="{{ __('common.partnership_page_form_routing_number') }}">
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" name="newsletter_subscription" class="form-check-input"
                                           id="latestVideos" checked>
                                    <label class="form-check-label"
                                           for="exampleCheck1">{{ __('common.receive_latest_videos') }}</label>
                                </div>
                            </div>
                            <input type="hidden" name="pay_pal_payment" value="false">
                            <button type="submit"
                                    class="btn btn-primary btn-width-equal">{{ __('common.send_btn_text') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="profile-tab">
                <form method="post" action="{{ route('donations.store') }}">
                    <input type="hidden" name="paypal_donation" value="true">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_first_name') }}</label>
                                <input type="text" class="form-control col-md-10" name="name"
                                       placeholder="{{ __('common.partnership_page_form_first_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_last_name') }}</label>
                                <input type="text" class="form-control col-md-12" name="last_name"
                                       placeholder="{{ __('common.partnership_page_form_last_name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_address') }}</label>
                                <input type="text" name="address" class="form-control col-md-10" placeholder="{{ __('common.partnership_page_form_address') }}">
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_telephone') }}</label>
                                <input type="tel" name="telephone" class="form-control col-md-10"
                                       placeholder="{{ __('common.partnership_page_form_telephone') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_email') }}</label>
                                <input type="email" name="email" class="form-control col-md-10"
                                       placeholder="{{ __('common.partnership_page_form_email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">{{ __('common.partnership_page_form_city_state') }}</label>
                                <input type="text" name="city" class="form-control col-md-10 mb-2"
                                       placeholder="{{ __('common.invitations_page_form_city') }}">
                                <input type="text" name="state" class="form-control col-md-10 mb-2"
                                       placeholder="{{ __('common.invitations_page_form_state') }}">
                                <input type="text" name="zip_code" class="form-control col-md-10 mb-2"
                                       placeholder="{{ __('common.invitations_page_form_zip_code') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" name="newsletter_subscription" class="form-check-input"
                                           id="latestVideos" checked="">
                                    <label class="form-check-label" for="exampleCheck1">{{ __('common.receive_latest_videos') }}</label>
                                </div>
                            </div>
                            <input type="hidden" name="pay_pal_payment" value="true">
                            <button type="submit" class="btn btn-primary btn-width-equal">{{ __('common.send_btn_text') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

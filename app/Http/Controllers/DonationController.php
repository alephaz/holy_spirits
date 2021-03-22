<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\NewsletterSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Jenssegers\Agent\Agent;

class DonationController extends Controller
{
    /**
     * Validate paypal payment validation
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function paypalValidate(Request $request)
    {
        // validate the request
        if ($request->has('amt') && $request->has('cm') && strlen($request->get('cm'))) {

            // convert the CM value to php object
            $payload = \GuzzleHttp\json_decode($request->get('cm'));

            // validate the conversion and update the donation model
            if ($payload && isset($payload->email) && isset($payload->donation_id)) {

                // update the donation model
                $donation = (new Donation())->find($payload->donation_id);

                // get the language and set the system locale and session with the language
                if (isset($payload->language) && $payload->language) {

                    // set the session with the language
                    session()->put('language', $payload->language);

                    // set the system language with the active language
                    app()->setLocale($payload->language);
                }

                // validate donation
                if ($donation) {

                    // update donation model
                    $donation->donation_amount = $request->get('amt');

                    // save donation
                    $donation->save();

                    // check if the user already exists
                    $user_validate = (new User())->where('email', $donation->email)->withTrashed();
					
                    // validate query
                    if ($user_validate->count()) {

                        $donated_user = $user_validate->first();

                    } else {

                        // if a user is not found, create the user with the donation details
                        $donated_user = (new User())->create([
                            'name' => $donation->name,
                            'password' => Hash::make($donation->email),
                            'email' => $donation->email,
                            'locale' => app()->getLocale(),
                            'address' => $donation->address,
                            'city' => $donation->city,
                            'state' => $donation->state,
                            'zip' => $donation->zip_code,
                            'telephone_phone' => $donation->telephone,
                            'monthly_donation_amount' => 0,
                            'newsletter_subscription' => $donation->newsletter_subscription
                        ]);

                        $donated_user->roles()->attach(2);

                        $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($donated_user);

                        $donated_user->notify((new \App\Notifications\NewUserFromDonation($token, $donated_user)));

                    }

                    // send the created user mail notification
                    if ($donated_user) {

                        // send donation notification
                      /*  Notification::route('mail', 'abm@abm.cc')
                            ->notify(new \App\Notifications\Donation($donation)); */
                            
                             Notification::route('mail', ['ABMpartnerrequest@gmail.com','free2harsha@gmail.com'])
                            ->notify(new \App\Notifications\Donation($donation));

                        // send thank you message
                        Notification::route('mail', $donated_user->email)
                            ->notify(new \App\Notifications\DonationThankYou());

                        // check if the user is logged in at least once, if not send the user to password reset page by creating active token
                        if(!$donated_user->last_login){

                            // get token token for the active user account
                            $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($donated_user);

                            // redirect user to the reset page
                            return redirect(url('/password/reset/' . $token . '?email=' . $donated_user->email));
                        }
                    }
                }
            }
        }

        // redirect user to the thank you page
        return redirect('/page/thank-you-for-partnering-with-us?language=' . app()->getLocale());
    }

    /**
     * Show the paypal donation page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function paypalDonation(Request $request)
    {

        if ($request->has('email') && $request->has('donation_id')) {
            return view('common.paypal_donation', [
                'email' => $request->get('email'),
                'donation_id' => $request->get('donation_id')
            ]);
        }

        return redirect(route('home'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // check if the user agent is not a bot and save the email address
        $agent = new Agent();

        if (!$agent->isRobot()) {

            // mutate the paypal_donation attribute
            $request->offsetSet('paypal_donation', $request->get('pay_pal_payment') === 'true' ? true : false);

            // check if the request has paypal_donation, if found check if its not true where the account ID must be validated
            if ($request->has('paypal_donation') && !$request->get('paypal_donation')) {

                // validate the request
                $request->validate([
                    'name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required',
                    'telephone' => 'required',
                    'account_number' => 'required',
                    'monthly_contribution' => 'required'
                ]);

            } else {

                // validate the request
                $request->validate([
                    'name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required',
                    'telephone' => 'required'
                ]);

            }

            // if all validations are correct, process the newsletter_subscriptions and pay_pal_payment arguments
            $request->offsetSet('newsletter_subscription', $request->get('newsletter_subscription') === 'on' ? true : false);

            $request->offsetSet('pay_pal_payment', $request->get('pay_pal_payment') === 'true' ? true : false);


            // create model
            $donation = (new Donation())->create($request->all());

            // validated the created donation
            if ($donation) {

                // check if the newsletter_subscription is true and create a newsletter subscription for the user email
                if ($request->get('newsletter_subscription')) {

                    // check if the email address exists
                    $newsletter_subscription = (new NewsletterSubscription())->where('email', $request->get('email'));

                    // validate the query by getting the count
                    if (!$newsletter_subscription->count()) {

                        // create a new subscription
                        (new NewsletterSubscription())->create([
                            'email' => $request->get('email'),
                            'language' => app()->getLocale()
                        ]);

                        // send thank you message for subscribing to the newsletter
                        Notification::route('mail', $request->get('email'))
                            ->notify(new \App\Notifications\NewsletterSubscription($request->get('email'), $request->get('name')));

                    }
                }


                // if the user is on the account donation page, after saving the donation, send the user to the thank you page.
                if ($request->has('paypal_donation') && !$request->get('paypal_donation')) {

                    // send notification message
                    // send donation notification
                    /* Notification::route('mail', ['abm@abm.cc'])
                        ->notify(new \App\Notifications\Donation($donation)); */
                        
                        Notification::route('mail', ['abmpartnerchecking@gmail.com','free2harsha@gmail.com'])
                        ->notify(new \App\Notifications\Donation($donation));

                    Notification::route('mail', $donation->email)
                        ->notify(new \App\Notifications\DonationThankYou());

                    // redirect user to the thank you page
                    return redirect('/page/thank-you-for-partnering-with-us?language=' . app()->getLocale());

                } else {

                    // redirect user to the paypal payment page
                    return redirect(route('donations.paypal-payment', ['email' => $donation->email, 'donation_id' => $donation->id]));

                }

            } else {

                // @todo add sentry watch here to check for incoming errors
                // return the user back to the donation page with error message
                return redirect()->back()->with('error_message', 'Sorry, The donation process occurred a problem. Please try again.');
            }

        }

        // redirect to home if the request was made by a bot
        return redirect('/');

    }


    /**
     * Create a user for the donation
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDonatedUser(Request $request)
    {
        // check if the user is an administrator
        if ($request->user()->can('viewAdministration')) {

            // validate the user information from the request
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip_code' => 'required'
            ]);

            // prepare data list to save
            $user_profile = (new User())->create([
                'name' => $request->get('name'),
                'locale' => 'en',
                'password' => Hash::make('password'),
                'email' => $request->get('email'),
                'address' => $request->get('address'),
                'city' => $request->get('city'),
                'state' => $request->get('state'),
                'zip' => $request->get('zip_code'),
                'telephone_phone' => $request->get('telephone'),
                'monthly_donation_amount' => $request->get('monthly_contribution'),
                'newsletter_subscription' => $request->get('newsletter_subscription')
            ]);

            $user_profile->roles()->attach(2);

            $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user_profile);

            $user_profile->notify((new \App\Notifications\NewUserFromDonation($token, $user_profile)));

            return response()->json([
                'status' => true,
                'user' => $user_profile,
                '_time' => Carbon::now()->timestamp
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use App\Models\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Jenssegers\Agent\Agent;

class RequestController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param string $type
     * @param string $route
     * @param int $key
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, string $type, string $route, int $key)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'captcha' => 'required|captcha'
        ]);
$url = 'https://www.google.com/recaptcha/api/siteverify';
$remoteip = $_SERVER['REMOTE_ADDR'];
$data = [
        'secret' => config('services.recaptcha.secret'),
        'response' => $request->get('recaptcha'),
        'remoteip' => $remoteip
      ];
$options = [
        'http' => [
          'header' => "Content-type: application/x-www-form-urlencoded\r\n",
          'method' => 'POST',
          'content' => http_build_query($data)
        ]
    ];
$context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result);
if ($resultJson->success != true) {
        return back()->withErrors(['captcha' => 'ReCaptcha Error']);
        }
if ($resultJson->score >= 0.3) {
        //Validation was successful, add your form submission logic here
      //  return back()->with('message', 'Thanks for your message!');

        // check if the user agent is not a bot and save the email address
        $agent = new Agent();

        if (!$agent->isRobot()) {

            $request->offsetSet('newsletter_subscription', $request->get('newsletter_subscription') === 'on' ? true : false);

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
                
                // else{
                //     // create a new subscription
                //     (new NewsletterSubscription())->create([
                //         'email' => $request->get('email'),
                //         'language' => app()->getLocale()
                //     ]);

                //     // send thank you message for subscribing to the newsletter
                //     Notification::route('mail', $request->get('email'))
                //         ->notify(new \App\Notifications\NewsletterSubscription($request->get('email'), $request->get('name')));
                // }
            }
            
             $user_request = (new UserRequest())->create($request->all());

            if (!$request->has('request_type')) {
                // set request type
                $request->offsetSet('request_type', 'prayer_request');
            }

            if($type == 'testimony'){
                Notification::route('mail', [$request->get('email')])
                    ->notify(new \App\Notifications\ThankYouTestimony());
                    
                Notification::route('mail', ['ABMtestimonies@gmail.com'])
                ->notify(new \App\Notifications\UserRequest($user_request));    
            }

            if($type == 'prayer_request'){
                Notification::route('mail', [$request->get('email')])
                    ->notify(new \App\Notifications\ThankYouPrayRequest());
                    
                Notification::route('mail', ['ABMprayerrequest@gmail.com'])
                ->notify(new \App\Notifications\UserRequest($user_request));  
            }

            if($type == 'contact_request'){
                Notification::route('mail', [$request->get('email')])
                    ->notify(new \App\Notifications\ThankYouComment());
                
                Notification::route('mail', ['ABMcontactrequest@gmail.com'])
                ->notify(new \App\Notifications\UserRequest($user_request)); 
            }


            // create request
            /*$user_request = (new UserRequest())->create($request->all());

            Notification::route('mail', ['abm@holyspirit.tv','support@holyspirit.tv'])
                ->notify(new \App\Notifications\UserRequest($user_request)); */

        }

        if ($key) {

            return redirect(route($route, [$key]))->with('prayer_request_success', ucfirst(str_replace('_', ' ', $type)) . ' successfully sent.');

        } else {

            return redirect(route($route))->with('prayer_request_success', ucfirst(str_replace('_', ' ', $type)) . ' successfully sent.');

        }

} else {
        return back()->withErrors(['captcha' => 'ReCaptcha Error']);
}
    }
}

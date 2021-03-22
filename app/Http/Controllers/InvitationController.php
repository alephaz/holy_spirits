<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class InvitationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'church_name' => 'required',
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

            }
        }

        // save invitation
        $invitation = (new \App\Models\Invitation())->create($request->all());

        // send user thank you message
        Notification::route('mail', [$request->get('email')])
            ->notify(new \App\Notifications\ThankYouInvite());

        
       /* Notification::route('mail', ['andres@abm.cc', 'abm@abm.cc'])
            ->notify(new \App\Notifications\InvitationNotification($invitation)); */
        
        Notification::route('mail', ['andres@holyspirit.tv', 'abm@holyspirit.tv','support@holyspirit.tv','ABMinvitation@gmail.com'])
            ->notify(new \App\Notifications\InvitationNotification($invitation));

        return redirect(route('invitations.index'))->with('success_message', 'Thank you for sending your invitation, we will get get back to you as soon as possible.');
   } else {
        return back()->withErrors(['captcha' => 'ReCaptcha Error']);
    }
}
}

<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NewsletterController extends Controller
{

    /**
     * Send test mail based on the newsletter
     *
     * @param Request $request
     * @param string $newsletter_id
     * @param string $email
     * @return array
     */
    public function sendTest(Request $request, string $newsletter_id, string $email)
    {
        // check if the email ID exists and the email exists
        $newsletter = (new \App\Models\Newsletter())->find($newsletter_id);

        // check if the newsletter model exists
        if ($newsletter) {

            // send thank you message for subscribing to the newsletter
            try {

                Mail::to($email)->send(new \App\Mail\Newsletter($newsletter));

                return [
                    'status' => true,
                    '_time' => Carbon::now()->timestamp
                ];

            } catch (\Exception $e) {
                return [
                    'status' => false,
                    'message' => $e->getMessage(),
                    '_time' => Carbon::now()->timestamp
                ];
            }

        }

        return [
            'status' => false,
            'message' => 'Newsletter not found',
            '_time' => Carbon::now()->timestamp
        ];

    }


    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show(string $id)
    {
        // get the newsletter
        $newsletter = (new \App\Models\Newsletter())->find($id);

        // validate and return the template
        if ($newsletter) {

            // return the newsletter template
            return new \App\Mail\Newsletter($newsletter);

        }

        // if no newsletter found, redirect the user to the home page
        return redirect(route('home'));
    }
}

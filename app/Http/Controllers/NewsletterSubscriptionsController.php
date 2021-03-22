<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NewsletterSubscriptionsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      /*  $request->validate([
            'newsletter_email' => 'unique:newsletter_subscriptions,email'
        ]);

        // check if the user agent is not a bot and save the email address
        $agent = new Agent();
        

        if (!$agent->isRobot()) {

            
            (new NewsletterSubscription())->create([
                'email' => $request->get('newsletter_email'),
                'language' => app()->getLocale()
            ]);
            
            $this->addMailJetContact($request->get('newsletter_email'));

            Notification::route('mail', $request->get('newsletter_email'))
                ->notify(new \App\Notifications\NewsletterSubscription($request->get('newsletter_email')));

        }

        if (app()->getLocale() === 'en') {

            if ($request->has('redirect')) {
                return redirect($request->get('redirect'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
            } else {
                return redirect(route('home'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
            }

        }

        if (app()->getLocale() === 'es') {

            if ($request->has('redirect')) {
                return redirect($request->get('redirect'))->with('news_letter_success', 'Gracias, usted ha sido registrado con éxito.');
            } else {
                return redirect(route('home'))->with('news_letter_success', 'Gracias, usted ha sido registrado con éxito.');
            }
        }
        
        if (app()->getLocale() === 'iw') {

            if ($request->has('redirect')) {
                return redirect($request->get('redirect'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
            } else {
                return redirect(route('home'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
            }

        }*/
        
        $email_validation = DB::connection('mysql')
                        ->table('newsletter_subscriptions')
                        ->where('email', $request->get('newsletter_email'));
					
		if (!$email_validation->count()) {
			
			// check if the user agent is not a bot and save the email address
			$agent = new Agent();
			

			if (!$agent->isRobot()) {

							
				(new NewsletterSubscription())->create([
					'email' => $request->get('newsletter_email'),
					'language' => app()->getLocale()
				]); 
								
				$this->addMailJetContact($request->get('newsletter_email'));

				Notification::route('mail', $request->get('newsletter_email'))
					->notify(new \App\Notifications\NewsletterSubscription($request->get('newsletter_email')));

			}

			if (app()->getLocale() === 'en') {

				if ($request->has('redirect')) {
					return redirect($request->get('redirect'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
				} else {
					return redirect(route('home'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
				}

			}

			if (app()->getLocale() === 'es') {

				if ($request->has('redirect')) {
					return redirect($request->get('redirect'))->with('news_letter_success', 'Gracias, usted ha sido registrado con éxito.');
				} else {
					return redirect(route('home'))->with('news_letter_success', 'Gracias, usted ha sido registrado con éxito.');
				}
			}
			
			if (app()->getLocale() === 'iw') {

				if ($request->has('redirect')) {
					return redirect($request->get('redirect'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
				} else {
					return redirect(route('home'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
				}

			}
		}else{
			$newsletter_list = false;

			// newsletter list ID
			// EN : 2, ES : 3  IW : 5
			if (app()->getLocale() == 'en') {
				$newsletter_list = 2;
			}

			if (app()->getLocale() == 'es') {
				$newsletter_list = 3;
			}
			
			if (app()->getLocale() == 'iw') {
				$newsletter_list = 5;
			} 
				
			$user_id = DB::connection('mysql_newsletter')
									->table('user_user')
									->where('email', $request->get('newsletter_email'));
									
			$user_id2 = DB::connection('mysql_newsletter')
									->table('listuser')
									->where('userid', $user_id->first()->id)
									->where('listid', $newsletter_list);
									
			// validate
			if (!$user_id2->count()) {

				// add the user to the newsletter list
				DB::connection('mysql_newsletter')
					->table('listuser')
					->insert([
						'userid' => $user_id->first()->id,
						'listid' => $newsletter_list,
						'entered' => Carbon::now(),
						'modified' => Carbon::now()
					]);
										
					$this->addMailJetContact($request->get('newsletter_email'));	
					Notification::route('mail', $request->get('newsletter_email'))
					->notify(new \App\Notifications\NewsletterSubscription($request->get('newsletter_email')));
					
				if (app()->getLocale() === 'en') {

					if ($request->has('redirect')) {
						return redirect($request->get('redirect'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
					} else {
						return redirect(route('home'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
					}

				}

				if (app()->getLocale() === 'es') {

					if ($request->has('redirect')) {
						return redirect($request->get('redirect'))->with('news_letter_success', 'Gracias, usted ha sido registrado con éxito.');
					} else {
						return redirect(route('home'))->with('news_letter_success', 'Gracias, usted ha sido registrado con éxito.');
					}
				}
				
				if (app()->getLocale() === 'iw') {

					if ($request->has('redirect')) {
						return redirect($request->get('redirect'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
					} else {
						return redirect(route('home'))->with('news_letter_success', 'Thank you, You have been successfully registered.');
					}

				} 
			
			}else{
				 $request->validate([
					'newsletter_email' => 'unique:newsletter_subscriptions,email'
				]);
			}

		}
    }
    
    private function addMailJetContact($email) {
            $url = 'https://api.mailjet.com/v3/REST/contact';
            $username = '40890a566c47761768308384f17954e7';
            $password = 'd9eb6308e4c46715fb9e37b6ada8b85f';

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_setopt($ch, CURLOPT_POST,           1 );
            curl_setopt($ch, CURLOPT_POSTFIELDS,     '{ "IsExcludedFromCampaigns": "true", "Name": "New Contact", "Email": "'.$email.'" }' ); 
            curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json')); 

            $response = curl_exec($ch);
             
            if(curl_errno($ch)){
                throw new Exception(curl_error($ch));
            }
    }
}

<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait PhpListSupport
{

    static function bootPhpListSupport()
    {
        static::created(function ($newsletterSubscription) {

            // validate the subscription model
            if ($newsletterSubscription->email && $newsletterSubscription->language) {

                // language
                $newsletter_list = false;

                // newsletter list ID
                // EN : 2, ES : 3  IW : 5
                if ($newsletterSubscription->language == 'en') {
                    $newsletter_list = 2;
                }

                if ($newsletterSubscription->language == 'es') {
                    $newsletter_list = 3;
                }
                
                if ($newsletterSubscription->language == 'iw') {
                    $newsletter_list = 5;
                }

                // check if the language is set and proceed to email address insert
                if ($newsletter_list) {
                    // check if the email already exists
                    $email_validation = DB::connection('mysql_newsletter')
                        ->table('user_user')
                        ->where('email', $newsletterSubscription->email);

// var_dump($email_validation);die;

                    // validate
                   
                    if (!$email_validation->count()) {
                        try {

                            // insert user to the user list
                            DB::connection('mysql_newsletter')
                                ->table('user_user')
                                ->insert([
                                    'email' => $newsletterSubscription->email,
                                    'confirmed' => 1,
                                    'blacklisted' => 0,
                                    'optedin' => 0,
                                    'bouncecount' => 0,
                                    'entered' => Carbon::now(),
                                    'modified' => Carbon::now(),
                                    'uniqid' => bin2hex(random_bytes(16)),
                                    'htmlemail' => 1
                                ]);

                            // get the user ID
                            $user_id = DB::connection('mysql_newsletter')
                                ->table('user_user')
                                ->where('email', $newsletterSubscription->email);

                            // validate
                            if ($user_id->count()) {

                                // add the user to the newsletter list
                                DB::connection('mysql_newsletter')
                                    ->table('listuser')
                                    ->insert([
                                        'userid' => $user_id->first()->id,
                                        'listid' => $newsletter_list,
                                        'entered' => Carbon::now(),
                                        'modified' => Carbon::now()
                                    ]);
                            }

                        } catch (\Exception $e) {
                            if (app()->bound('sentry')) {
                                app('sentry')->captureException($e);
                            }
                        }
                    }else{
                        
                        ////////
                        // get the user ID
                            $user_id = DB::connection('mysql_newsletter')
                                ->table('user_user')
                                ->where('email', $newsletterSubscription->email);

                            // validate
                            if ($user_id->count()) {

                                // add the user to the newsletter list
                                DB::connection('mysql_newsletter')
                                    ->table('listuser')
                                    ->insert([
                                        'userid' => $user_id->first()->id,
                                        'listid' => $newsletter_list,
                                        'entered' => Carbon::now(),
                                        'modified' => Carbon::now()
                                    ]);
                            }
                    //////
                        
                        ///////
                    }
                }
            }
        });

        static::deleted(function ($newsletterSubscription) {

            // find the user with email
            $user_query = DB::connection('mysql_newsletter')
                ->table('user_user')
                ->where('email', $newsletterSubscription->email);

            // validate
            if ($user_query->count()) {

                // get user object
                $user = $user_query->first();

                // remove the listuser relationship and remove the user record
                DB::connection('mysql_newsletter')
                    ->table('listuser')
                    ->where('userid', $user->id)
                    ->delete();

                // remove user record
                DB::connection('mysql_newsletter')
                    ->table('user_user')
                    ->where('id', $user->id)
                    ->delete();

            }

        });

    }

}
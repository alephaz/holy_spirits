<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

Auth::routes();


Route::get('/send-welcome/{page}', function ($page) {

    ini_set('max_execution_time', 0);

    $users = (new \App\Models\User())->orderBy('id', 'asc')
        ->where('id', '>', 15)
        ->where('last_login', null)
        ->offset($page * 100)
        ->limit(100)
        ->get();

    foreach ($users as $user) {

        // get the first part of the email
        $email_start = explode('@', $user->email);

        if (!empty($email_start)) {

            // create password string
            $password = $email_start[0] . '_holyspirit';

            // update the password
            $user->password = Hash::make($password);

            // save the updated model
            $user->save();

            // send mail
            $user->notify((new \App\Notifications\NewUserRegistered($user, $password)));
        }

        echo $user->email . ' -- Sent <br />';
    }

    dd('done');
});
//
//Route::get('/test-email', function () {
//
//    $user = (new \App\Models\User())->find(12);
//
//    $token = app(Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user);
//
////    return (new \App\Notifications\NewUserFromDonation($token, $user))->render();
//
//    $user->notify((new \App\Notifications\NewUserFromDonation($token, $user)));
//
//});
//
//
//Route::get('/test-email', function () {
//
//    Notification::route('mail', 'abm@abm.cc')
//        ->notify(new \App\Notifications\WelcomeUser());
//
//    dd('done');
//
//});

/**
 * Language switch
 */
Route::get('/language/{language}', [
    'as' => 'language.switch',
    'uses' => function ($language) {

        // set session with the new language code
        session()->put('language', $language);

        // return the user to the home page
        return redirect(route('home'));
    }
]);

Route::get('/invitations', [
    'as' => 'invitations.index',
    'uses' => function () {

        return view('common.invitations');
    }
]);

Route::post('/invitations', [
    'as' => 'invitations.store',
    'uses' => 'InvitationController@store'
]);

Route::get('/new-book', [
    'as' => 'redirect.new-book',
    'uses' => function () {
        return redirect('/page/new-book', 301);
    }
]);

Route::get('/capitulo-uno-nuevo-libro/', [
    'as' => 'redirect.new-book-chapter-one',
    'uses' => function () {

        // set session with the new language code
        session()->put('language', 'es');
        return redirect('/page/book-chapter-one', 301);
    }
]);

Route::get('/profile', [
    'as' => 'profile.index',
    'uses' => 'ProfileController@index'
]);

Route::get('/profile/{user}/edit', [
    'as' => 'profile.edit',
    'uses' => 'ProfileController@edit'
]);

Route::post('/profile/{user}/update', [
    'as' => 'profile.update',
    'uses' => 'ProfileController@update'
]);

Route::get('/profile/{user}/password-reset', [
    'as' => 'profile.password-reset',
    'uses' => 'ProfileController@passwordReset'
]);

Route::post('/profile/{user}/password-save', [
    'as' => 'profile.password-save',
    'uses' => 'ProfileController@passwordResetSave'
]);

Route::get('/donations', [
    'as' => 'donations.index',
    'uses' => function () {

        return view('common.donations');
    }
]);

Route::post('/create-donated-user', [
    'as' => 'donations.create-user',
    'uses' => 'DonationController@createDonatedUser'
]);

Route::get('/partnership', [
    'as' => 'donations.index',
    'uses' => function () {
        return view('common.partnership');
    }
]);

Route::post('/partnership', [
    'as' => 'donations.store',
    'uses' => 'DonationController@store'
]);

Route::get('/partnership/paypal-payment', [
    'as' => 'donations.paypal-payment',
    'uses' => 'DonationController@paypalDonation'
]);

Route::get('/partnership/paypal-validate', [
    'as' => 'donations.paypal-validate',
    'uses' => 'DonationController@paypalValidate'
]);

Route::get('/prayer-request', [
    'as' => 'prayer-request.index',
    'uses' => function () {
        return view('common.user_request', [
            'form' => 'prayer_request'
        ]);
    }
]);

Route::get('/testimony', [
    'as' => 'testimony.index',
    'uses' => function () {

        return view('common.user_request', [
            'form' => 'testimony'
        ]);
    }
]);

Route::get('/privacy-policy', [
    'as' => 'privacy_policy.index',
    'uses' => function () {

        return view('common.privacy_policy');
    }
]);

Route::get('/comments-questions', [
    'as' => 'comments-questions.index',
    'uses' => function () {

        return view('common.user_request', [
            'form' => 'contact_request'
        ]);
    }
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/channel/{slug}', [
    'as' => 'channel.show',
    'uses' => 'VideoChannelController@show'
]);

Route::get('/events', [
    'as' => 'event.index',
    'uses' => 'EventController@index'
]);

Route::get('/event/{slug}', [
    'as' => 'event.show',
    'uses' => 'EventController@show'
]);

Route::get('/', 'HomeController@index');

Route::get('/page/{slug}', [
    'as' => 'page.show',
    'uses' => 'PageController@show'
]);

Route::post('/save/newsletter', [
    'as' => 'newsletter-subscribe',
    'uses' => 'NewsletterSubscriptionsController@store'
]);

Route::post('/save/request/{type}/{route}/{key}', [
    'as' => 'save-request',
    'uses' => 'RequestController@store'
]);

Route::get('/newsletter/test/{newsletter_id}/{email}', [
    'as' => 'newsletter.send-test',
    'uses' => 'NewsletterController@sendTest'
]);

Route::get('/newsletter/{id}', [
    'as' => 'newsletter.view',
    'uses' => 'NewsletterController@show'
]);

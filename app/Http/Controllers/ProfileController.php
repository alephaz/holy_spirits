<?php

namespace App\Http\Controllers;

use App\Models\MultiMedia;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // book list
        $books = [];

        // get all the media books
        $books_query = (new MultiMedia())
            ->where('type', 'book')
            ->where('language', app()->getLocale());

        // validate
        if ($books_query->count()) {
            $books = $books_query->get();
        }

        return view('profile.index', [
            'books' => $books
        ]);
    }

    public function edit(Request $request, User $user)
    {
        return view('profile.edit', [
            'user' => $user
        ]);
    }

    public function passwordReset(Request $request, User $user)
    {
        return view('profile.password', [
            'user' => $user
        ]);
    }

    public function passwordResetSave(Request $request, User $user)
    {

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);


        $user->password = Hash::make($request->get('password'));

        $user->setRememberToken(Str::random(60));

        $user->save();

        return redirect(route('profile.index'))->with('profile_saved', __('common.label_profile_password_updated'));
    }

    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);


        // transform birthday
        if ($request->has('birth_date')) {

            $request->offsetSet('birth_date', Carbon::parse($request->get('birth_date')));
        }

        $request->offsetSet('newsletter_subscription', $request->get('newsletter_subscription') === 'on' ? true : false);

        if($user->update($request->toArray())){
            return redirect(route('profile.index'))->with('profile_saved', __('common.label_profile_updated'));
        }
    }
}

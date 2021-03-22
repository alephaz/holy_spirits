<?php

namespace App\Http\Controllers;

use App\Models\VideoChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VideoChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {

        // check if the slug is valid
        if ($slug && strlen($slug)) {

            // check if the slug has a video channel
            $video_channel = (new VideoChannel())
                ->with(['videos' => function ($q) {

                    // create a clone of the query object in order to perform the validation
                    $validation = clone $q;

                    // check if there are videos for the active language and add the condition
                    if ($validation->where('language', app()->getLocale())->count()) {

                        $q->where('language', app()->getLocale());

                    } else {
                        // get the videos for the default language "en"
                        $q->where('language', 'en');
                    }

                    // order the videos by the weight
                    $q->orderBy('weight', 'desc');
                }])
                ->where('slug', $slug)
                ->first();

            // check if the query is valid and a video channel is loaded
            if ($video_channel) {

                // check if the video has user roles added to it, if any role is found it is taken as a protected
                // video channel
                if ($video_channel->roles->count()) {

                    // check if the user is logged in
                    if (Auth::user() && Auth::user()->can('view', $video_channel)) {
                        // return video list view with the videos
                        return view('video_channel.index', [
                            'channel' => $video_channel,
                            'videos' => $video_channel->videos,
                            'login_form' => false
                        ]);

                    } else {
                        // show the login page
                        // return video list view with the videos
                        return view('video_channel.index', [
                            'channel' => $video_channel,
                            'videos' => [],
                            'login_form' => true
                        ]);
                    }
                } else {

                    // return video list view with the videos
                    return view('video_channel.index', [
                        'channel' => $video_channel,
                        'videos' => $video_channel->videos,
                        'login_form' => false
                    ]);
                }
            }
        }

        // if something fails, send the user to the 404 page
        abort(404);
    }
}

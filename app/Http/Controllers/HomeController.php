<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoChannel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //  get the home video channel
        $home_channel = (new VideoChannel())->where('slug', 'home')->first();

        // validate check if the channel exists
        if ($home_channel) {

            // video collection
            $videos = collect([]);

            // get the videos specifically for the active language
            $language_specific_videos = (new Video())
                ->where('language', app()->getLocale())
                ->whereHas('channels', function ($q) {
                    $q->where('slug', 'home');
                })->get();

            // check if there are language specific videos and merge in to the video collection
            if($language_specific_videos->count()){
                $videos = $videos->merge($language_specific_videos);
            }

            // get all the videos with the language as neutral
            $common_videos = (new Video())
                ->where('language', 'neutral')
                ->whereHas('channels', function ($q) {
                    $q->where('slug', 'home');
                })->get();

            // check if there are common videos and merge in to the video collection
            if($common_videos->count()){
                $videos = $videos->merge($common_videos);
            }

            // sort all the videos according to the weight
            if($videos->count()){

                // sort all the videos according to the weight
                $videos = $videos->sortByDesc('weight');
            }

            return view('home.index', [
                'videos' => $videos
            ]);
        }

//        // get all the videos for the home channel
//        $home_channel = (new VideoChannel())
//            ->where('slug', 'home')
//            ->with(['videos' => function ($q) {
//                // create a clone of the query object in order to perform the validation
//                $validation = clone $q;
//
//                $q->where('language', app()->getLocale())
//                    ->orWhere('language', 'neutral');
//
////                 // check if there are videos for the active language and add the condition
////                 if ($validation->where('language', app()->getLocale())->count()) {
//
////                     $q->where('language', app()->getLocale());
//
////                 } else {
////                     // get the videos for the default language "en"
////                     $q->where('language', 'en');
////                 }
//
//                // order the videos by the weight
//                $q->orderBy('weight', 'desc');
//            }])
//            ->first();
//
//        $videos = [];
//
//        // if a video channel is found, get all the videos
//        if ($home_channel) {
//            $videos = $home_channel->videos;
//        }
//
//        return view('home.index', [
//            'videos' => $videos
//        ]);
    }
}

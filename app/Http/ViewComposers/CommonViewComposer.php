<?php

namespace App\Http\ViewComposers;


use App\Models\Menu;
use App\Models\VideoChannel;
use Illuminate\View\View;
use Jenssegers\Agent\Agent;

class CommonViewComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {

        $video_channel_list = [];

        // get all the video channels and loop through it and create the channel list
        foreach ((new VideoChannel())->orderBy('weight', 'ASC')->get() as $video_channel) {

//            // check if the user can view the video channel
//            if (auth()->user() && auth()->user()->can('view', $video_channel)) {
//
//                // if the validation passes, add the video channel to the channel list
//                $video_channel_list[] = $video_channel;
//            } else {
//                // if a user is not available, show only the channels do not have a rule attached to it
//                if ($video_channel->roles && !$video_channel->roles->count()) {
//
//                    // if the validation passes, add the video channel to the channel list
//                    $video_channel_list[] = $video_channel;
//                }
//            }

            $video_channel_list[] = $video_channel;
        }


        $navigation_menu = [];

        // get all the menu items and loop through it to create a menu list
        $menu_items = (new Menu())->orderBy('id', 'asc')->get();

        // validate and create menu items
        if ($menu_items && $menu_items->count()) {

            // loop through the menu items and create the menu tree
            foreach ($menu_items as $menu_item) {

                if (app()->getLocale() != 'en' && $menu_item->id == 10) {
                    continue;
                }

                if ($menu_item->menu_id === null) {
                    $navigation_menu[$menu_item->id] = [
                        'title' => $menu_item->title,
                        'slug' => $menu_item->slug,
                        'children' => []
                    ];
                }
            }

            // loop through the menu items and create the menu tree
            foreach ($menu_items as $menu_item) {

                if (app()->getLocale() != 'en' && $menu_item->id == 10) {
                    continue;
                }

                if (isset($navigation_menu[$menu_item->menu_id])) {
                    $navigation_menu[$menu_item->menu_id]['children'][] = [
                        'title' => $menu_item->title,
                        'slug' => $menu_item->slug
                    ];
                }
            }
        }

        $view->with([
            'channels' => $video_channel_list,
            'menu' => $navigation_menu,
            'language' => app()->getLocale(),
            'agent' => new Agent(),
            'languages' => config('translatable.locales'),
            'user' => auth()->user()
        ]);
    }
}
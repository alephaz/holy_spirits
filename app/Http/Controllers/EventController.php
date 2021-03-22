<?php

namespace App\Http\Controllers;


use App\Models\Event;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // check of the request has old events to show previous events
        $show_old = $request->has('past_events');

        // check for an active year in the request and show the events based on the active year
        $show_year = $request->has('year');

        // create events query
        $events = (new Event());

        // if show old is active, show only the old events
        if ($show_old) {

            $events = $events
                ->where('event_date', '<=', Carbon::now())
                ->orderBy('event_date', 'asc');

        } else if ($show_year) {

            $active_year = (int)$request->get('year');

            $events = $events
                ->where('event_date', '<=', Carbon::createFromDate($active_year, 12, 31))
                ->where('event_date', '>=', Carbon::createFromDate(($active_year - 1), 12, 31))
                ->orderBy('event_date', 'asc');

        } else {

            $events = $events
                ->where('event_date', '<=', Carbon::createFromDate(date('Y'), 12, 31))
                ->where('event_date', '>=', Carbon::createFromDate((date('Y') - 1), 12, 31))
                ->orderBy('event_date', 'asc');
        }

        $pagination = [];
        $display_events = [];

        // validate the query and return the results
        if ($events->count()) {

//            $pagination = $events->paginate();

//            if (count($pagination->items())) {
//
//                foreach ($pagination->items() as $item) {
//                    $display_events[$item->event_date->format('Y')][] = $item;
//                }
//
//            }
//
//            // append the current request query to the pagination
//            $pagination = $pagination->appends(request()->query());

            foreach ($events->get() as $item) {
                $display_events[$item->event_date->format('Y')][] = $item;
            }

        }


        $show_edit = false;
        // check if a user is logged in an is an admin
        if (auth()->user() && auth()->user()->roles) {
            // check if the user has the admin role
            if (auth()->user()->roles->pluck('slug')->search('administrator') > -1) {
                $show_edit = true;
            }
        }

        return view('event.index', [
            'events' => $display_events,
            'pagination' => $pagination,
            'show_edit' => $show_edit
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        return view('event.show');
    }
}

<?php

namespace App\Nova;

use Adlux\MultiDateSelector\MultiDateSelector;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Invitations extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Invitation';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),


            Text::make('Name', 'name')
                ->creationRules('required'),
            Text::make('Church name', 'church_name')
                ->creationRules('required'),
            Text::make('Email', 'email')
                ->creationRules('required', 'email'),
            Text::make('Address', 'address'),
            Text::make('City', 'city')
                ->hideFromIndex(),
            Text::make('State', 'state')
                ->hideFromIndex(),
            Text::make('Zip code', 'zip_code')
                ->hideFromIndex(),
            Country::make('Country', 'country'),
            Text::make('Telephone phone', 'telephone_phone')
                ->hideFromIndex(),
            Text::make('Mobile phone', 'mobile_phone')
                ->hideFromIndex(),
            Text::make('Website', 'website')
                ->hideFromIndex(),
            Text::make('Event type', 'event_type')
                ->hideFromIndex(),
            Text::make('Venue capacity', 'venue_capacity')
                ->hideFromIndex(),
            Text::make('Expected attendance', 'expected_attendance')
                ->hideFromIndex(),
            MultiDateSelector::make('Tentative dates', 'tentative_dates')
                ->format('Y-m-d'),
            Textarea::make('Previous event details', 'previous_event_details')
                ->hideFromIndex(),
            Textarea::make('Message', 'message')
                ->hideFromIndex(),
            Boolean::make('Newsletter subscription', 'newsletter_subscription')

        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}

<?php

namespace App\Nova;

use Adlux\MultiDateSelector\MultiDateSelector;
use Benjaminhirsch\NovaSlugField\Slug;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use MrMonat\Translatable\Translatable;

class Event extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Event';

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
        'title'
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

            Translatable::make('Title')
                ->singleLine()
                ->creationRules('required'),

            Translatable::make('Description')
                ->trix()
                ->creationRules('required')
                ->hideFromIndex(),

            Date::make('Event date')
                ->creationRules('required'),

            Text::make('City', 'city'),

            MultiDateSelector::make('Dates')
                ->format('Y-m-d')
                ->hideFromIndex(),

            Country::make('Country', 'country')
                ->creationRules('required')
                ->hideFromIndex(),

            Slug::make('Slug')
                ->creationRules('required')
                ->hideFromIndex(),

            new Panel('Media', [
                Image::make('Featured Image')->disk('public')
            ]),
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

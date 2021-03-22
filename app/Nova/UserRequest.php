<?php

namespace App\Nova;


use App\Nova\Filters\RequestType;
use App\Nova\Metrics\UserRequests;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class UserRequest extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\UserRequest';

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
        'name',
        'email'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name', 'name')->creationRules('required'),

            Text::make('Email', 'email')->creationRules('required', 'email'),

            Textarea::make('Message', 'message')
                ->creationRules('required'),
            Boolean::make('Newsletter Subscription', 'newsletter_subscription')
                ->hideFromIndex(),
            Select::make('Request type', 'request_type')->options([
                'prayer_request' => 'Prayer',
                'testimony' => 'Testimony',
                'comment_question' => 'Comment Request',
                'contact_request' => 'Contact Request',
                'book_request' => 'Book Request'
            ])->displayUsing(function ($e) {
                return ucwords(str_replace('_', ' ', $e));
            }),
            Date::make('Requested On', 'created_at')
                ->sortable()
                ->hideWhenCreating()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new UserRequests,
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new RequestType()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new DownloadExcel)
                ->only('name', 'email', 'message', 'request_type')
                ->withHeadings(),
        ];
    }

    /**
     * Set Resource label
     * @return string
     */
    public static function label()
    {
        return 'Requests';
    }
}

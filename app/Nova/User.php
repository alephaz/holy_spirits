<?php

namespace App\Nova;

use App\Nova\Actions\EmailPasswordReset;
use App\Nova\Actions\MakePartner;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Panel;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\User';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
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
            new Panel('User information', [
                ID::make()->sortable(),

                Gravatar::make(),

                Text::make('User Name', 'name')
                    ->sortable()
                    ->rules('required', 'max:255'),

                Text::make('First Name')
                    ->sortable()
                    ->rules('max:255'),


                Text::make('Last Name')
                    ->sortable()
                    ->rules('max:255'),

                Select::make('Gender')->options([
                    'male' => 'Male',
                    'female' => 'Female'
                ])
                    ->help('Optional')
                    ->hideFromIndex(),

                Select::make('Language', 'locale')->options([
                    'en' => 'English',
                    'es' => 'Spanish'
                ])
                    ->rules('required')
                    ->help('User language which will enable the user to view the website with his preferred language'),

                Date::make('Birthday', 'birth_date')
                    ->help('Optional')
                    ->hideFromIndex(),

                Text::make('Email')
                    ->sortable()
                    ->rules('required', 'email', 'max:254')
                    ->creationRules('unique:users,email')
                    ->updateRules('unique:users,email,{{resourceId}}'),

                Password::make('Password')
                    ->onlyOnForms()
                    ->creationRules('required', 'string', 'min:6')
                    ->updateRules('nullable', 'string', 'min:6'),

                Date::make('Last Login')
                    ->sortable()
                    ->onlyOnIndex()
            ]),
            new Panel('Address information', [

                Text::make('Address')
                    ->rules('max:255')
                    ->hideFromIndex(),

                Text::make('City')
                    ->rules('max:255')
                    ->hideFromIndex(),

                Text::make('State')
                    ->rules('max:255')
                    ->hideFromIndex(),

                Text::make('Zip')
                    ->rules('max:255')
                    ->hideFromIndex(),

                Text::make('Country')
                    ->rules('max:255')
                    ->hideFromIndex(),

                Text::make('Telephone number', 'telephone_phone')
                    ->rules('max:255')
                    ->hideFromIndex(),

                Text::make('Mobile number', 'mobile_phone')
                    ->rules('max:255')
                    ->hideFromIndex(),

                Text::make('Routing number', 'routing_number')
                    ->rules('max:255')
                    ->hideFromIndex(),

                Text::make('Account number', 'account_number')
                    ->rules('max:255')
                    ->hideFromIndex(),

                Number::make('Monthly donation amount', 'monthly_donation_amount')
                    ->hideFromIndex(),

                Boolean::make('Newsletter subscription', 'newsletter_subscription'),


            ]),

            BelongsToMany::make('Roles')
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
        return [
            new Metrics\NewUsers
        ];
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
        return [
            new MakePartner(),
            new EmailPasswordReset()
        ];
    }
}

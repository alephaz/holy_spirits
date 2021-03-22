<?php

namespace App\Nova;

use Adlux\CreateDonatedUser\CreateDonatedUser;
use App\Nova\Filters\PartnershipType;
use App\Nova\Metrics\NewDonations;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\Excel\Excel;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Donation extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Donation';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'email';

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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('First Name', 'name')
                ->creationRules('required')
                ->hideFromIndex(),
            Text::make('Last Name', 'last_name')
                ->creationRules('required')
                ->hideFromIndex(),                        
            Text::make('Email', 'email')
                ->creationRules('required', 'email'),
            Text::make('Address', 'address')->hideFromIndex(),
            Text::make('City', 'city'),
            Text::make('State', 'state')->hideFromIndex(),
            Text::make('Zip code', 'zip_code')->hideFromIndex(),
            Text::make('Telephone', 'telephone')->hideFromIndex(),
            Number::make('Routing number', 'routing_number')->hideFromIndex(),
            Number::make('Account number', 'account_number')->hideFromIndex(),
            Number::make('Monthly contribution', 'monthly_contribution'),
            Number::make('PayPal Donation', 'donation_amount'),
            Boolean::make('Newsletter subscription', 'newsletter_subscription'),
            Boolean::make('PayPal Payment', 'pay_pal_payment')->onlyOnDetail(),
            DateTime::make('Donated at', 'created_at')->onlyOnIndex(),
            CreateDonatedUser::make('User', '')
                ->onlyOnIndex()
                ->withMeta(['isDonatedUserHasAccount' => $this->isDonatedUserHasAccount(), 'donation' => $this->toArray()])
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
            new NewDonations
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
        return [
            new PartnershipType()
        ];
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

    /**
     * Check if the donated user already has an account
     *
     * @return bool
     */
    private function isDonatedUserHasAccount(): bool
    {

        try {

            // check if the model has an email address
            if (isset($this->email)) {

                // check if there is an user exists with the same email address
                $partner_users = (new \App\Models\User())
                    ->where('email', $this->email)
                    ->get();

                // check if the users exists, if found return as true
                if ($partner_users && $partner_users->count()) {
                    return true;
                }
            }

        } catch (\Exception $e) {

            return false;

        }

        return false;
    }
}

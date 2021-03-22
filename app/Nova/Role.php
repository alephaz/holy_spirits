<?php

namespace App\Nova;

use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Panel;

class Role extends Resource
{
    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Models\Role';

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

            TextWithSlug::make('Name')
                ->slug('Slug')
                ->creationRules('required')
                ->sortable(),

            Slug::make('Slug')
                ->creationRules('required'),

            new Panel('Permissions', [
                Checkboxes::make('Permissions')
                    ->options($this->getRouteList())
                    ->hideFromIndex()
            ])
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

    private function getRouteList(): array
    {
        // route list
        $routeCollection = Route::getRoutes();

        // local variable to hold route name list
        $permissions = [];

        $permission_list = [];

        if ($routeCollection->count()) {

            foreach ($routeCollection as $value) {
                $permissions[] = $value->getName();
            }

            // once the permission list is loaded with all the routes, remove the empty null items and remove duplicates
            if (!empty($permissions)) {

                // remove duplicates
                $permissions = array_unique($permissions);

                // remove null items
                $permissions = array_filter($permissions);

                // loop through the list and create permission list
                foreach ($permissions as $permission) {

                    // split the route by .
                    $route_params = explode('.', $permission);

                    if (isset($route_params[0])) {
                        $permission_list[$permission] = trim(str_replace('.', ' ', $permission));
                    }
                }
            }
        }

        return $permission_list;
    }
}

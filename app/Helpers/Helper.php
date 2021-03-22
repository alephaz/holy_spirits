<?php


use Illuminate\Support\Facades\Route;

if (!function_exists('route_get_alias_list')) {
    /**
     * Get laravel route alias
     *
     * This function returns all the route aliases added in the routes list,
     * this is being used in the system in order to provide access based on the user permissions
     * @param array $options
     * @return array
     */
    function route_get_alias_list(array $options = []): array
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
                        $permission_list[] = $permission;
                    }
                }
            }
        }

        return $permission_list;
    }
}

<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Video;
use App\Models\VideoChannel;
use App\Policies\UserPolicy;
use App\Policies\VideoChannelPolicy;
use App\Policies\VideoPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        VideoChannel::class => VideoChannelPolicy::class,
        Video::class => VideoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        /**
         * Define a gate to check if the user has the role administrator and to allow access
         */
        Gate::define('viewAdministration', function ($user) {

            // check the user if they has the administrator role
            if ($user->roles && $user->roles->count()) {
                foreach ($user->roles as $role) {
                    if ($role->slug === 'administrator') {
                        return true;
                    }
                }
            }

            return false;
        });

        /**
         * Define a gate to check if the user has made a donation and the user role is created as a partnet
         */
        Gate::define('viewPaidContent', function ($user) {

            // check the user if they has the administrator role
            if ($user->roles && $user->roles->count()) {
                foreach ($user->roles as $role) {
                    if ($role->slug === 'partner') {
                        return true;
                    }
                }
            }

            return false;
        });
    }
}

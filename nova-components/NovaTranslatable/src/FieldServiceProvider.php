<?php

namespace Adlux\NovaTranslatable;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-translatable', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-translatable', __DIR__.'/../dist/css/field.css');
            Nova::script('nova-translatable-ck-editor', 'https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

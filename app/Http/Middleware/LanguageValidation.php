<?php

namespace App\Http\Middleware;

use Closure;

class LanguageValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // check if there is a language key in the session
        if($request->session()->has('language')){

            // set session language to the application
            app()->setLocale($request->session()->get('language'));
            
        }else{
            
            // check if the domain is
            if(in_array('espiritusanto', explode('.', parse_url($request->url(), PHP_URL_HOST)))){

                // set site domain on config files
                config(['app.url' => 'https://www.espiritusanto.com']);

                // set session language to the applica¡tion
                app()->setLocale('es');

                // set session with the new language code
                session()->put('language', 'es');

            }
            
            // check if the domain is
            if(in_array('hebrew', explode('.', parse_url($request->url(), PHP_URL_HOST)))){

                // set site domain on config files
                config(['app.url' => 'https://hebrew.holyspirit.tv']);

                // set session language to the applica¡tion
                app()->setLocale('iw');

                // set session with the new language code
                session()->put('language', 'iw');

            }
            
            
             // check if the domain is
            if(in_array('ruachadonai', explode('.', parse_url($request->url(), PHP_URL_HOST)))){

                // set site domain on config files
                config(['app.url' => 'https://www.ruachadonai.tv']);

                // set session language to the applica¡tion
                app()->setLocale('iw');

                // set session with the new language code
                session()->put('language', 'iw');

            }
            
            
        }
        
        // check if the request has a language key
        if($request->has('language')){
            
            // set session language to the application
            app()->setLocale($request->get('language'));
            
            // set session with the new language code
            session()->put('language', $request->get('language'));
        }

        return $next($request);
    }
}

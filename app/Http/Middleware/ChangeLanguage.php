<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeLanguage
{
    public function handle($request, Closure $next)
    {
        app()->setLocale('ar');

        if(isset($request -> lang)  && $request -> lang == 'en' )
            app()->setLocale('en');

        return $next($request);
    }
}

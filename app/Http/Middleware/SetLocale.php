<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header_lang = explode(',', $request->server('HTTP_ACCEPT_LANGUAGE'));
        foreach ($header_lang as $lang) {
            $lang = explode('-', $lang)[0];
            if (in_array($lang, Config::get('app'))) {
                App::setLocale($lang);
                break;
            }
        }

        return $next($request);
    }
}


<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class ReCaptchaPasses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(App::environment(['production', 'testing']))
        {
            if($request->has('recaptchaToken'))
            {
                $gResponse = Http::post("https://www.google.com/recaptcha/api/siteverify?secret=".config('services.googleRecaptcha.secretKey')."&response=".$request->recaptchaToken);
                
                if($gResponse->ok() && $gResponse->object()->success === true)
                {
                    return $next($request);
                } else {
                    return response([], 202);
                }

            } else {
                return response([], 202);
            }
        }

        return $next($request);
    }
}

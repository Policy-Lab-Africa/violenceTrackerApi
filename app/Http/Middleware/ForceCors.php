<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ForceCors
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
        
        $response = $next($request);

        if(App::environment(['local']))
        {
            $response
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', '*')
            ->header('Access-Control-Allow-Credentials', 'true');
        } else {

            $response
            ->header('Access-Control-Allow-Origin', 'https://violencetrack.ng')
            ->header('Access-Control-Allow-Origin', 'https://app.violencetrack.ng')
            ->header('Access-Control-Allow-Origin', 'https://www.violencetrack.ng')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, OPTIONS')
            ->header('Access-Control-Allow-Headers', '*')
            ->header('Access-Control-Allow-Credentials', 'true');

        }


        return $response;
    }
}

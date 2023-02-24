<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecaptchaController extends Controller
{
    //

    public function verifyToken(Request $request)
    {
        $request->validate([
            'recaptchaToken' => 'required|string',
        ]);

        $gResponse = Http::post("https://www.google.com/recaptcha/api/siteverify?secret=".config('services.googleRecaptcha.secretKey')."&response=".$request->recaptchaToken);
                
        if($gResponse->ok() && $gResponse->object()->success === true)
        {
            return $this->sendResponse([
                'success' => true
            ]);

        } else {
            return $this->sendError([
                'success' => false
            ], 400);
        }
    }
}

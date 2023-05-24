<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;

class CustomAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasCookie('asscess-token')){
            return redirect('/');
        }else{
            $token = $request->cookie('asscess-token');
            $this->decryptToken($token);
        }

        return $next($request);
    }

    function decryptToken($token) {
        if ($this->isGoogleAccessTokenValid($token)) {
            // Token is valid
            // Proceed with the desired logic
            return response()->json(['message' => 'Token is valid'], 200);
        } else {
            // Token is invalid
            // Handle the invalid token scenario
            return response()->json(['message' => 'Token is invalid'], 401);
        }
    }

    public function isGoogleAccessTokenValid($accessToken)
    {
        try {
            // Retrieve user details using the access token
            $user = Socialite::driver('google')->userFromToken($accessToken);
    
            // If the token is valid, the user object will be returned
            return $user !== null;
        } catch (\Exception $e) {
            // An exception occurred during token verification
            // Handle the exception or return false
            return false;
        }
    }
}

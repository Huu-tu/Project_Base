<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;
use Cookie;

class CustomAuth
{
    public function handle(Request $request, Closure $next)
    {
        $isAuth = $request->input('param');
        // dd($isAuth);         
        if($isAuth === 'true'){
            return $next($request);
        }else{
            if (!$request->hasCookie('asscess-token')){
                $backTo = $request->url();
                Cookie::queue('back-to',$backTo);
                return redirect()->route('index');
            }else{
                $token = $request->cookie('asscess-token');
                $this->decryptToken($token);
            }

            return $next($request);
        }
    }

    function decryptToken($token) {
        if ($this->isGoogleAccessTokenValid($token)) {
            // Token is valid
            return true;
        } else {
            // Token is invalid
            return false;
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

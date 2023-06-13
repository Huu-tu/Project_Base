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
        $isAuth = $request->input('isAuth');

        // dd($isAuth);
        // $private = '-----BEGIN RSA PRIVATE KEY-----
        // MIIBOgIBAAJBAKj34GkxFhD90vcNLYLInFEX6Ppy1tPf9Cnzj4p4WGeKLs1Pt8Qu
        // KUpRKfFLfRYC9AIKjbJTWit+CqvjWYzvQwECAwEAAQJAIJLixBy2qpFoS4DSmoEm
        // o3qGy0t6z09AIJtH+5OeRV1be+N4cDYJKffGzDa88vQENZiRm0GRq6a+HPGQMd2k
        // TQIhAKMSvzIBnni7ot/OSie2TmJLY4SwTQAevXysE2RbFDYdAiEBCUEaRQnMnbp7
        // 9mxDXDf6AU0cN/RPBjb9qSHDcWZHGzUCIG2Es59z8ugGrDY+pxLQnwfotadxd+Uy
        // v/Ow5T0q5gIJAiEAyS4RaI9YG8EWx/2w0T67ZUVAw8eOMB6BIUg0Xcu+3okCIBOs
        // /5OiPgoTdSy7bcF9IGpSE8ZgGKzgYQVZeN97YE00
        // -----END RSA PRIVATE KEY-----';
        
        // // $ciphertext = 'TUpQL0tMQVVoK2N6Z1QyT0JpZEtsU1cxcEs5eEZqR2pqSkpxY3lTZWN3d0RRTnJ0TlRnWFFCa25uZ3c4MnNkOHNWdkRpUzgvMEdYVi9hdjdSSy9QOGRpVGZJMlBza0FIOHJUMnhxdW1HZW5aWmRJYTRIZzc1NzRSWmk2ajJmMWZWTmpqbGk1bTVueW1vTDI0cTI1a1V4OGhPUU5NOU04UFFPWTNmL0RnSVRzPQ%3D%3D';
        
        // $private = openssl_get_privatekey($private);
        
        // openssl_private_decrypt(base64_decode($isAuth), $plaintext, $private, OPENSSL_PKCS1_PADDING);
        
        // echo $plaintext;        

        if($isAuth === 'true'){
            return $next($request);
        }else{
            if (!session()->get('asscess-token')){
                $backTo = $request->url();
                session()->put('back-to',$backTo);
                return redirect()->route('index');
            }else{
                $token = session()->get('asscess-token');
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

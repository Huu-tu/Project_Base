<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Cookie;

class AuthController extends Controller
{
    public function loginWithGoogle(Request $request)
    {
        $campus = $request->campus_id;
        if(!$campus){
            return redirect()->route('index')->with('error', 'Login failed'); 
        }
        if (session()->has('campus')) {
            session()->forget('campus');
        }
        session()->put('campus', $campus);
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            $is_user = User::where('email', $user->getEmail())->first();
            $campus = session()->get('campus');
            if(!$is_user){
                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId()),
                    'campus' => $campus
                ]);
                Cookie::queue('asscess-token', $user->token, 120);
                $backTo = Cookie::get('back-to');
                if($backTo){
                    return redirect($backTo);
                }
                return redirect()->route('home');    
            }else{
                // $saveUser = User::where('email',  $user->getEmail())->update([
                //     'google_id' => $user->getId(),
                // ]);
                // $saveUser = User::where('email', $user->getEmail())->first();
                $campusDb = $is_user->campus;
                if($campusDb === $campus){
                    Cookie::queue('asscess-token', $user->token, 120);
                    $backTo = Cookie::get('back-to');
                    if($backTo){
                        return redirect($backTo);
                    }
                    return redirect()->route('home');    
                }else{
                    // $errorData = session()->put('error', 'Login failed');
                    //return redirect()->route('index'); 
                    return redirect()->route('index')->withErrors(['error' => 'Your error message']); 
                }
            } 
        } catch (\Throwable $e) {
            return redirect()->route('index')->with(['error' => $e]); 
        }
    }

    public function logout(Request $request){
        if($request->hasCookie('asscess-token')){
            Cookie::queue(Cookie::forget('asscess-token'));
            return redirect('/');
        }else{
            return response()->json(['message' => 'Logout fail'], 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Cookie;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function loginWithGoogle(Request $request)
    {
        $campus = $request->campus_id;
        if(!$campus){
            return response()->json(['message' => 'Login fail'], 400);
        }

        if (session()->has('campus')) {
            session()->forget('campus');
        }
        
        session()->put('campus', $campus);

        return Socialite::driver('google')->with(['access_type' => 'offline'])->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
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
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            } 

            $campusDb = User::where('campus',$campus)->first();
            if($campusDb){
                Cookie::queue('asscess-token', $user->token, 120);

                $backTo = Cookie::get('back-to');
    
                if($backTo){
                    return redirect($backTo);
                }
                return redirect()->route('home');    
            }else{
                return response()->json(['message' => 'Login fail'], 400);
            }

        } catch (\Throwable $th) {
            throw $th;
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

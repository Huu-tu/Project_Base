<?php

namespace App\Http\Controllers;

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
            if(!$is_user){

                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }

            Cookie::queue('asscess-token', $user->token, 120);
            
            return redirect()->route('home');
            // return response()->json(['token' => $user->token]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout(Request $request){
        if($request->hasCookie('asscess-token')){
            Cookie::forget('asscess-token');
            return response()->json(['message' => 'Logout success'], 200);
        }else{
            return response()->json(['message' => 'Logout fail'], 400);
        }
    }
}

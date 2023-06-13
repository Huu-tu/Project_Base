<?php

namespace App\Services;

use App\Repositories\AuthRespository;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthService{
    protected $authRespository;

    public function __construct(AuthRespository $authRespository){
        $this->authRespository = $authRespository;
    }

    public function loginWithGoogle($request){
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

    public function callbackFromGoogle(){
        $user = Socialite::driver('google')->user();
        $is_user = $this->authRespository->getEmail($user->getEmail());
        $campus = session()->get('campus');
        if(!$is_user){
            $this->authRespository->callbackFromGoogle([
                'google_id' => $user->getId(),
            ],[
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make($user->getName().'@'.$user->getId()),
                'campus' => $campus
            ]);
            session()->put('asscess-token', $user->token);
            $backTo = session()->get('back-to');
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
                    session()->put('asscess-token', $user->token);
                    $backTo = session()->get('back-to');
                    if($backTo){
                        return redirect($backTo);
                    }
                    return redirect()->route('home');    
                }else{
                    return redirect()->route('index')->withErrors(['error' => 'Your error message']); 
                }
            } 
    }

    public function logOut(){
        if(session()->has('asscess-token')){
            session()->forget('asscess-token');
            return redirect('/');
        }else{
            return response()->json(['message' => 'Logout fail'], 400);
        }
    }
}
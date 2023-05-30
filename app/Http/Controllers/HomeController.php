<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use Cookie;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    public function index(){
        $campus = Campus::orderBy('id')->get('key');

        return view('welcome', [
            'campus' => $campus,
        ]);
    }

    public function home(){
        // $backTo = Cookie::get('back-to');
        // if($backTo){
        //     Cookie::queue(Cookie::forget('back-to'));
        // }

        return view('home');
    }

    public function campus(){
        $campus = Campus::all();

        return response()->json($campus);
    }
     
    public function inFoUser(Request $request){
        $token = $request->cookie('asscess-token');
        $user = Socialite::driver('google')->userFromToken($token);

        // $email = $user->email;
        // $name = $user->name;

        // return response()->json($user);
        dd($user);
    }
}

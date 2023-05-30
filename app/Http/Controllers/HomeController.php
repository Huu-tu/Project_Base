<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use Cookie;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function home(){
        return view('home');
    }

    public function campus(){
        $campus = Campus::all();
        return [
            "status" => 200,
            "data" => $campus
        ];
    }
     
    public function inFoUser(Request $request){
        $token = $request->cookie('asscess-token');
        $user = Socialite::driver('google')->userFromToken($token);
        return response()->json($user);
    }
}

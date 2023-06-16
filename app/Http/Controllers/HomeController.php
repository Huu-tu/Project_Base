<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use App\Models\User;
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
     
    public function inFoUser(){
        $token = session()->get('asscess-token');
        $userGg = Socialite::driver('google')->userFromToken($token);
        $user =  User::where('google_id', $userGg->getId())->first();
        return response()->json($user);
    }
}

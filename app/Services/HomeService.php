<?php

namespace App\Services;

use App\Repositories\CampusRespository;
use Laravel\Socialite\Facades\Socialite;

class HomeService{
    protected $campusRespository;

    public function __construct(CampusRespository $campusRespository){
        $this->campusRespository = $campusRespository;
    }

    public function campus(){
        $result = $this->campusRespository->index();
        return response()->json($result);
    }

    public function inFoUser(){
        $token = session()->get('asscess-token');
        $user = Socialite::driver('google')->userFromToken($token);
        return response()->json($user);
    }
}
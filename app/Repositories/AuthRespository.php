<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthRespository extends BaseRepository{
    public function getModel(){
        return User::class;
    }

    public function getEmail($email){
        return User::where('email', $email)->first();
    }

    public function callbackFromGoogle($id,  $data){
        return User::updateOrCreate($id,  $data);
        // return $this->updateOrCreate($id,$data);
    }

}
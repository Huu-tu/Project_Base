<?php

namespace App\Repositories;

use App\Models\Campus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CampusRespository extends BaseRepository{
    public function getModel(){
        return Campus::class;
    }

    public function index(){
        return $this->_model::all();
    }
}
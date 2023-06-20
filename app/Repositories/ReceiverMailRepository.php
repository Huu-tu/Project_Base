<?php

namespace App\Repositories;

use App\Models\Receivers_mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReceiverMailRepository extends BaseRepository{
    public function getModel(){
        return Receivers_mail::class;
    }

    public function saveData($data) {
        return $this->create($data);
    }
}
<?php

namespace App\Repositories;

use App\Models\Mails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MailRepository extends BaseRepository{
    public function getModel(){
        return Mails::class;
    }

    public function index(){
        return $this->_model::all();
    }

    public function search($data){
        return $this->_model->where('title', 'LIKE','%'.$data.'%')->get();
    }

    public function show($id){
        return $this->_model->where('id', $id)->get();
    }

    public function store($data){
        return $this->create($data);
    }

    public function getReceiver($id){
        return $this->_model::find($id)->feedbacks;
    }

    public function saveData($data, $id) {
        $mail = $this->_model->findOrFail($id);
        return $mail->update($data);
    }

    public function confirm($id){
        $permission = $this->_model->findOrFail($id);
        return $permission->update(['need_confrim' => 1]);
    }

    public function reject($id){
        $permission = $this->_model->findOrFail($id);
        return $permission->update(['need_confrim' => 2]);
    }

    public function delete($id){
        return $this->delete($id);
    }
}
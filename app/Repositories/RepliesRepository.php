<?php

namespace App\Repositories;
use App\Models\Reply;

class RepliesRepository extends BaseRepository{
    public function getModel(){
        return Reply::class;
    }

    public function index(){
        return $this->_model::all();
    }

    public function store($data){
        return $this->create($data);
    }

    public function delete($id){
        return $this->delete($id);
    }
}
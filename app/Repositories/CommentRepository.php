<?php

namespace App\Repositories;
use App\Models\Comments;

class CommentRepository extends BaseRepository{
    public function getModel(){
        return Comments::class;
    }

    public function index(){
        return $this->_model::all();
    }

    public function getReply($id){
        return $this->_model::find($id)->replies;
    }

    public function store($data){
        return $this->create($data);
    }

    public function delete($id){
        return $this->delete($id);
    }
}
<?php

namespace App\Repositories;

abstract  class BaseRepository
{
    protected $_model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    public function getAll(){
        return $this->_model::all();
    }

    public function getEmail($email){
        return $this->_model->where('email', $email)->first();
    }

    public function search($data){
        return $this->_model->where('title', 'LIKE','%'.$data.'%')->get();
    }

    public function create(array $data){
        return $this->_model->create($data);
    }

    // public function show($id){
    //     return $this->_model->create($data);
    // }

    public function updateOrCreate($id,  $data){
        return $this->_model->updateOrCreate($id,  $data);
    }



    public function update(array $attributes){
        return $this->_model->update($attributes);
//        $result = $this->find($id);
//        if ($result) {
//            $result->update($attributes);
//
//            return $result;
//        }
//
//        return false;
    }

    public function find($id){
        $result = $this->_model->find($id);

        return $result;
    }

    public function deleteAll(){
//        return $this->_model->destroy($id)
    }

    public function delete($id){
        $result = $this->_model->findOrFail($id);
        if ($result) {
            $result->delete();
            return true;
        }

        return false;
    }
}
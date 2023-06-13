<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PermissionRepository extends BaseRepository{
    public function getModel(){
        return Permission::class;
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

    public function isChecked($id){
        $permission =  $this->_model->findOrFail($id);
        return $permission->update(['is_checked' => true]);
    }

    public function confirm($id){
        $permission = $this->_model->findOrFail($id);
        $permission->status = 'Xac nhan';
        return $permission->save();
    }

    public function reject($id){
        $permission = $this->_model->findOrFail($id);
        $permission->status = 'Tu choi';
        return $permission->save();
    }

    public function delete($id){
        return $this->delete($id);
    }
}
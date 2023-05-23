<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(){
        $result = Permission::all();
        return [
            "status" => 200,
            "data" => $result
        ];
    }

    public function search(Request $request){
        $result = Permission::where('title', 'LIKE','%'.$request->keyword.'%')->get();
        return [
            "status" => 200,
            "data" => $result
        ];
    }
    
    public function show($id){
        $result = Permission::where('id', $id)->get();
        return [
            "status" => 200,
            "data" => $result
        ];
    }

    public function store(){
        request() ->validate([
            'title' => 'required',
            'content' => 'required',
            'email' => 'required',
            'sender' => 'required',
        ]);

        $result = Permission::create([
            'title' => request('title'),
            'content' => request('content'),
            'email' => request('email'),
            'sender' => request('sender'),
        ]);
        return [
            "status" => 200,
            "message" => 'Success'
        ];
    }

    public function confirm($id){
        $permission = Permission::findOrFail($id);
        $permission->status = 'Xac nhan';
        $permission->save();
        return [
            "status" => 200,
            "message" => 'Success'
        ];
    }

    public function reject($id){
        $permission = Permission::findOrFail($id);
        $permission->status = 'Tu choi';
        $permission->save();
        return [
            "status" => 200,
            "message" => 'Success'
        ];
    }

    public function edit(Request $request,$id){
        $data = $request->only([
            'title',
            'content',
            'status'
        ]);

        $permission = Permission::findOrFail($id);
        if($permission){
            $permission->update($data);
            return [
                "status" => 200,
                "data" => $permission
            ];
        }else{
            return [
                "status" => 404,
                "message" => 'Fail'
            ];        
        }
    }

    public function delete($id){
        $result = Permission::find($id)->delete();
        return [
            "status" => 200,
            "message" => 'Success'
        ];    
    }
}

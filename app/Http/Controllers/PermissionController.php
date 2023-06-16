<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Services\PermissService;

class PermissionController extends Controller
{
    protected $permissService;
    public function __construct(PermissService $permissService){
        $this->permissService = $permissService;
    }

    public function index(){
        return $this->permissService->getAll();
    }

    public function search(Request $request){
        return $this->permissService->search($request);
    }
    
    public function show($id){
        return $this->permissService->show($id);
    }

    public function getComment($id){
        return $this->permissService->getComment($id);
    }

    public function store(Request $request){
        return $this->permissService->store($request);
    }

    public function isChecked($id){
        return $this->permissService->isChecked($id);
    }

    public function confirm($id){
        return $this->permissService->confirm($id);
    }

    public function reject($id){
        return $this->permissService->reject($id);
    }

    public function delete($id){
        return $this->permissService->delete($id);    
    }
}

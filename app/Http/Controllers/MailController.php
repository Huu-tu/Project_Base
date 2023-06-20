<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MailService;

class MailController extends Controller{
    protected $mailService;
    public function __construct(MailService $mailService){
        $this->mailService = $mailService;
    } 

    public function index(){
        return $this->mailService->getAll();
    }

    public function search(Request $request){
        return $this->mailService->search($request);
    }
    
    public function show($id){
        return $this->mailService->show($id);
    }

    // public function getComment($id){
    //     return $this->permissService->getFeedback($id);
    // }

    public function store(Request $request){
        return $this->mailService->store($request);
    }

    public function saveData(Request $request, $id){
        return $this->mailService->saveData($request, $id);
    }

    public function confirm($id){
        return $this->mailService->confirm($id);
    }

    public function reject($id){
        return $this->mailService->reject($id);
    }

    public function delete($id){
        return $this->mailService->delete($id);    
    }

}

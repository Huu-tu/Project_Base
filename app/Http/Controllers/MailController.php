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
        $mail = $this->mailService->getAll();
        return $mail;
    }

    public function search(Request $request){
        $mail = $this->mailService->search($request);
        return $mail;
    }
    
    public function show($id){
        $mail = $this->mailService->show($id);
        return $mail;
    }

    public function store(Request $request){
        $mail = $this->mailService->store($request);
        return $mail;
    }

    public function getReceiver($id){
        $mail = $this->mailService->getReceiver($id);
        return $mail;
    }

    public function confirm($id){
        $mail = $this->mailService->confirm($id);
        return $mail;
    }

    public function reject($id){
        $mail = $this->mailService->reject($id);
        return $mail;
    }

    public function delete($id){
        $mail = $this->mailService->delete($id);  
        return $mail;  
    }
}

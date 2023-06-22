<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReceiverMailService;

class ReceiverMailController extends Controller{
    protected $receiverMailService;
    public function __construct(ReceiverMailService $receiverMailService){
        $this->receiverMailService = $receiverMailService;
    } 

    public function store(Request $request){
        $receiverMail = $this->receiverMailService->saveData($request);
        return $receiverMail;  
    }
}

<?php

namespace App\Services;

use App\Repositories\MailRepository;
use Phpseclib3\Crypt\RSA;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;

class MailService{
    protected $mailRepository;

    public function __construct(MailRepository $mailRepository){
        $this->mailRepository = $mailRepository;
    }

    public function getAll(){
        $responseData = $this->mailRepository->getAll();

        // $encryptedData = Crypt::encryptString($responseData);

        // $encryptionKey = env('APP_KEY');
        // $encryptionMethod = 'AES-256-CBC';
        // $iv = substr(md5($encryptionKey), 0, 16);
        
        // $ResponseData = openssl_encrypt($responseData, $encryptionMethod, $encryptionKey, 0, $iv);
        // $decryptedData = openssl_decrypt($encryptedData, $encryptionMethod, $encryptionKey, 0, $iv);
        // dd($ResponseData);
        return response()->json($result);

        return [
            "status" => 200,
            "data" => $responseData
        ];
    }

    public function search($request){
        $result = $this->mailRepository->search($request->keyword);
        return [
            "status" => 200,
            "data" => $result 
        ];
    }

    public function show($id){
        $result = $this->mailRepository->show($id);
        return [
            "status" => 200,
            "data" => $result
        ];
    }

    public function store($request){
        $variant = [
            (object)[
                'submit' => $request['submit'], 
                'textField' => $request['textField']
            ],
        ];

        $data = [
            'title' => $request['title'],
            'content' => $request['content'],
            'sender' => $request['sender'],
            'email' => $request['email'],
            'variant' => json_encode($variant),
            'need_confirm' => $request['submit'],
            'need_feedback' => $request['textField'],
        ];

        $result = $this->mailRepository->store($data);
        return response()->json($result);
    }

    public function getReceiver($id){

        $result = $this->mailRepository->getReceiver($id);
        return response()->json($result);
    }

    public function confirm($id){
        $this->mailRepository->confirm($id);
        return [
            "status" => 200,
            "message" => 'Success'
        ];
    }

    public function reject($id){
        $this->mailRepository->reject($id);
        return [
            "status" => 200,
            "message" => 'Success'
        ];
    }

    public function delete($id){
        $this->mailRepository->delete($id);
        return [
            "status" => 200,
            "message" => 'Success'
        ];   
    }
}

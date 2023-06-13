<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Illuminate\Support\Facades\Crypt;

class PermissService{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository){
        $this->permissionRepository = $permissionRepository;
    }

    public function getAll(){
        $responseData = $this->permissionRepository->getAll();
        $encryptionKey = 'key';
        $encryptionMethod = 'AES-256-CBC';
        $iv = substr(md5($encryptionKey), 0, 16);
        
        $ResponseData = openssl_encrypt($responseData, $encryptionMethod, $encryptionKey, 0, $iv);
        // $decryptedData = openssl_decrypt($encryptedData, $encryptionMethod, $encryptionKey, 0, $iv);

        return [
            "status" => 200,
            "data" => $ResponseData
        ];
    }

    public function search($request){
        $result = $this->permissionRepository->search($request->keyword);
        return [
            "status" => 200,
            "data" => $result 
        ];
    }

    public function show($id){
        $result = $this->permissionRepository->show($id);
        return [
            "status" => 200,
            "data" => $result
        ];
    }

    public function store($request){
        $data = $request->only([
            'title',
            'content',
            'email',
            'sender',
            'type',
            'party'
        ]);

        $result = $this->permissionRepository->store($data);
        return response()->json($result);
    }

    public function isChecked($id){
        $this->permissionRepository->isChecked($id);
        return [
            "status" => 200,
            "message" => 'Success'
        ];
    }

    public function confirm($id){
        $this->permissionRepository->confirm($id);
        return [
            "status" => 200,
            "message" => 'Success'
        ];
    }

    public function reject($id){
        $this->permissionRepository->reject($id);
        return [
            "status" => 200,
            "message" => 'Success'
        ];
    }

    public function delete($id){
        $this->permissionRepository->delete($id);
        return [
            "status" => 200,
            "message" => 'Success'
        ];   
    }
}

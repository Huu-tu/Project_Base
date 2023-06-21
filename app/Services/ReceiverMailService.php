<?php

namespace App\Services;

use App\Repositories\ReceiverMailRepository;
use App\Models\User;

class ReceiverMailService{
    protected $receiverMailRepository;

    public function __construct(ReceiverMailRepository $receiverMailRepository){
        $this->receiverMailRepository = $receiverMailRepository;
    }

    public function saveData($request){
        // $idUser = $request['mail_id'];

        // $mail_id = User::where('google_id',$idUser)->get('id');

        $data = [
            'user_mail' => $request['user_mail'],
            'mail_id' => $request['mail_id'],
            'confirm' => $request['confirm'],
            'feedback' => $request['feedback'],
        ];

        $result = $this->receiverMailRepository->saveData($data);
        return response()->json($result);
    }

}

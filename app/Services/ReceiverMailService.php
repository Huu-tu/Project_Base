<?php

namespace App\Services;

use App\Repositories\ReceiverMailRepository;
use App\Models\User;
use Phpseclib3\Crypt\RSA;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;

class ReceiverMailService{
    protected $receiverMailRepository;

    public function __construct(ReceiverMailRepository $receiverMailRepository){
        $this->receiverMailRepository = $receiverMailRepository;
    }

    public function saveData($request){
        $idUser = $request['mail_id'];

        $mail_id = User::where('google_id',$idUser)->get('id');

        $data = [
            'user_mail' => $request['user_mail'],
            'mail_id' => $mail_id,
            'confirm' => $request['confirm'],
            'feedback' => $request['feedback'],
        ];

        $data = $request->all();

        $result = $this->receiverMailRepository->saveData($data);
        return response()->json($result);
    }

}

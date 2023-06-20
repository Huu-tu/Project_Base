<?php

namespace App\Services;

use App\Repositories\ReceiverMailRepository;
use Phpseclib3\Crypt\RSA;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;

class ReceiverMailService{
    protected $receiverMailRepository;

    public function __construct(ReceiverMailRepository $receiverMailRepository){
        $this->receiverMailRepository = $receiverMailRepository;
    }

    public function saveData($request){
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

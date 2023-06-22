<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiverMailController;
use App\Http\Controllers\MailController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/mail/store',[
    MailController::class, 
    'store'
]);

Route::get('/mails' ,[
    MailController::class,
    'index'
]);

Route::get('/get-receiver/{id}' ,[
    MailController::class,
    'getReceiver'
]);

Route::post('/receiver-mail/store',[
    ReceiverMailController::class, 
    'store'
]);
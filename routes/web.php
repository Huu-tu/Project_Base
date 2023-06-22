<?php

use phpseclib3\Crypt\RSA;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReceiverMailController;
use App\Http\Controllers\MailController;

Route::get('/', [
    HomeController::class,
    'index'
])->name('index');

Route::get('/list', function() {
    return view('list');
});

Route::get('/api/campus', [
    HomeController::class,
    'campus'
]);

Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [AuthController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [AuthController::class, 'callbackFromGoogle'])->name('callback');
});

Route::group(['middleware' =>['customAuTh']], function (){
    Route::get('/home/{id}', [
        HomeController::class,
        'home'
    ])->name('home');

    Route::get('/info-user' ,[
        HomeController::class,
        'inFoUser'
    ]);

    Route::get('/mail' ,[
        MailController::class,
        'search'
    ]);

    Route::get('/mail/{id}',[
        MailController::class,
        'show'
    ]);

    Route::get('/get-receiver/{mail}/{id}' ,[
        MailController::class,
        'getReceiver'
    ]);    

    Route::post('/mail/save-data/{id}',[
        MailController::class,
        'saveData'
    ]);
    
    Route::delete('/mail/delete/{id}',[
        MailController::class,
        'delete'
    ]);

    Route::post('/receiver-mail/store',[
        ReceiverMailController::class, 
        'store'
    ]);

    Route::get('/logout',[
        AuthController::class,
        'logout'
    ]);
});

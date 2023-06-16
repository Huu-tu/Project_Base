<?php

use phpseclib3\Crypt\RSA;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CommentsController;

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

Route::get('/permissions' ,[
    PermissionController::class,
    'index'
]);

Route::get('/info-user' ,[
    HomeController::class,
    'inFoUser'
]);

Route::group(['middleware' =>['customAuTh']], function (){
    Route::get('/home/{id}', [
        HomeController::class,
        'home'
    ])->name('home');

    // Route::get('/info-user' ,[
    //     HomeController::class,
    //     'inFoUser'
    // ]);
    
    Route::get('/permission' ,[
        PermissionController::class,
        'search'
    ]);
    
    Route::get('/permission/{id}',[
        PermissionController::class,
        'show'
    ]);

    Route::get('/permission/is_checked/{id}',[
        PermissionController::class,
        'isChecked'
    ]);
    
    Route::get('/permission/confirm/{id}',[
        PermissionController::class,
        'confirm'
    ]);
    
    Route::get('/permission/reject/{id}',[
        PermissionController::class,
        'reject'
    ]);
    
    Route::delete('/permission/delete/{id}',[
        PermissionController::class,
        'delete'
    ]);

    Route::get('/permission/getComment/{id}',[
        PermissionController::class, 
        'getComment'
    ]);

    Route::get('/comments/get-reply/{id}',[
        CommentsController::class, 
        'getReply'
    ]);
    
    Route::post('/comment/store',[
        CommentsController::class, 
        'store'
    ]);
    
    Route::post('/comment/reply',[
        CommentsController::class, 
        'reply'
    ]);

    Route::get('/logout',[
        AuthController::class,
        'logout'
    ]);
});

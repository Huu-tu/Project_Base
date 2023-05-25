<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;


Route::get('/', [
    HomeController::class,
    'index'
]);

Route::get('/api/campus', [
    HomeController::class,
    'campus'
]);

Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [AuthController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [AuthController::class, 'callbackFromGoogle'])->name('callback');
});

Route::post('/permissions/store',[
    PermissionController::class,
    'store'
]);

Route::group(['middleware' =>['customAuTh']], function (){
    Route::get('/home/{id}', [
        HomeController::class,
        'home'
    ])->name('home');

    Route::get('/permissions' ,[
        PermissionController::class,
        'index'
    ]);
    
    Route::get('/permission' ,[
        PermissionController::class,
        'search'
    ]);
    
    Route::get('/permission/{id}',[
        PermissionController::class,
        'show'
    ]);
    
    Route::get('/permission/confirm/{id}',[
        PermissionController::class,
        'confirm'
    ]);
    
    Route::get('/permission/reject/{id}',[
        PermissionController::class,
        'reject'
    ]);
    
    
    Route::put('/permission/edit/{id}',[
        PermissionController::class,
        'edit'
    ]);
    
    Route::delete('/permission/delete/{id}',[
        PermissionController::class,
        'delete'
    ]);

    Route::get('/logout',[
        AuthController::class,
        'logout'
    ]);
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [
    HomeController::class,
    'home'
]);

Route::get('/api/campus', [
    HomeController::class,
    'campus'
]);

Route::get('/home', function () {
    return view('home');
})->name('home');;

Route::get('/show', function () {
    return view('show');
});

Route::prefix('google')->name('google.')->group( function(){
    Route::get('login', [AuthController::class, 'loginWithGoogle'])->name('login');
    Route::any('callback', [AuthController::class, 'callbackFromGoogle'])->name('callback');
});

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

Route::post('/permissions/store',[
    PermissionController::class,
    'store'
]);

Route::put('/permission/edit/{id}',[
    PermissionController::class,
    'edit'
]);

Route::delete('/permission/delete/{id}',[
    PermissionController::class,
    'delete'
]);
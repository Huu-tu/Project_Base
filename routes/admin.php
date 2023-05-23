<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PermissionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/permissions' ,[
//     PermissionController::class,
//     'index'
// ]);

Route::get('/permission' ,[
    PermissionController::class,
    'search'
]);

Route::get('/permissions/{id}',[
    PermissionController::class,
    'detail'
]);

// Route::post('/permissions/store',[
//     PermissionController::class,
//     'store'
// ]);

Route::put('/permissions/edit',[
    PermissionController::class,
    'storeProduct'
]);

Route::delete('/permissions/delete',[
    PermissionController::class,
    'storeProduct'
]);
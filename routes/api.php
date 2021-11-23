<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    
    Route::post('verify-account', [AuthController::class, 'verify_account']);
    Route::post('update-profile', [ProfileController::class, 'update']);

    Route::middleware('role:admin')->group(function () {

        
        Route::post('store-invitation', [InvitationController::class, 'store']);
    
    });

});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PartyController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\JsonResponse;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('parties', PartyController::class);
    Route::post('users/join', [UserController::class, 'join']);
    // Route::apiResource('users', UserController::class);
});

Route::middleware('auth:sanctum')->get('/test', function (Request $request) {
    // return $request->user();
    $test = "OK";
    return response()->json($test, 200);
    // return $request->user();
});

// Route::get('/test', function (Request $request) {
//     return response()->json("OK", 200);
// });

<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'v1/'], function () {
    Route::get('hello', [Controller::class, 'getHello'])->middleware([env('THROTTLE_GET')])->name('getHello');
    Route::post('hello', [Controller::class, 'postHello'])->middleware([env('THROTTLE_POST')])->name('postHello');
});

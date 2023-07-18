<?php

use App\ApplicationName\Authentication\Infrastructure\Actions\AuthAction;
use App\ApplicationName\Registration\Infrastructure\Actions\RegisterUserAction;
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
Route::prefix('v1')->group(function () {
    Route::post('/user/register', RegisterUserAction::class);

    Route::post('/user/auth', AuthAction::class);
});

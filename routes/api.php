<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\MailController;
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

/*
Route::get('/mail', [MailController::class, 'index']);
Route::post('/mail', [MailController::class, 'send']);
*/
Route::get('/',function (Request $request){ return response()->json(['Sucesso'],200); });

Route::get('/courses', [CourseController::class, 'index']);
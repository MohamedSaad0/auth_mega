<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});

//user register
Route::get('/register', [AuthController::class, 'create']);
Route::post('/register', [AuthController::class, 'register']);

// user login
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'logView']);
Route::get('/home', function(){
    return view('user.home');
})->name('home');

// Protected Routes

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);

});

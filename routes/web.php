<?php

use App\Http\Controllers\Oauth\YandexController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['yandexClientId' => config('services.yandex.client_id')]);
});

Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
Route::get('/user/test', [UserController::class, 'test'])->name('user.test');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/yandex/verification-code',  [YandexController::class, 'verificationCode'])->name('yandex.verificationCode');

Route::get('/test/test',  [TestController::class, 'test'])->name('test.test');

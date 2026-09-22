<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublikasiController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('publikasi', PublikasiController::class)->except(['show']);

    Route::get('/galeri', fn () => view('galeri.index'))->name('galeri.index');

    Route::prefix('api')->group(function () {
        Route::get('/bps', [ApiController::class, 'bps'])->name('api.bps');
        Route::get('/weather', [ApiController::class, 'weather'])->name('api.weather');
        Route::get('/earthquake', [ApiController::class, 'earthquake'])->name('api.earthquake');
        Route::get('/infographics', [ApiController::class, 'infographics'])->name('api.infographics');
        Route::get('/publikasi', [ApiController::class, 'publications'])->name('api.publikasi');
    });
});

Route::redirect('/home', '/');

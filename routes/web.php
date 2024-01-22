<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Route::get('/', 'LinkController@index');
    // Route::post('/shorten', 'LinkController@store');
    // Route::get('/{shortUrl}', 'LinkController@redirect');
    // Route::get('/statistics/{shortUrl}', 'LinkController@statistics');

    Route::controller(UrlShortenerController::class)->group(function () {
        Route::get('/shorten', 'index')->name('shorten.index');
        Route::post('/shorten', 'store')->name('shorten.store');
        Route::get('/{shortUrl}', 'shortener_url')->name('shorten.redirect');
        Route::get('/statistics/{shortUrl}', 'statistics')->name('shorten.statistics');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

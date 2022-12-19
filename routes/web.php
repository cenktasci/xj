<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\BonusHuntController;
use App\Http\Controllers\BonusHuntGameController;
use App\Http\Controllers\Controller;
use App\Models\BonusHuntGame;
use App\Models\Provider;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

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


Route::get('/addProvider', 'ProviderController@create2')->name('addProvider.create2');
Route::get('/addGame', 'ProviderController@create3')->name('addProvider.create3');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/bonushunt/bonushuntgame/{id}', [BonusHuntGameController::class, 'create'])->name('bonushunt.bonushuntGame.create');
    Route::get('/bonushunt/bonushuntgame/edit/{id}', [BonusHuntGameController::class, 'edit'])->name('bonushunt.bonushuntGame.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::resource('provider', ProviderController::class);
    Route::resource('game', GameController::class);
    Route::resource('bonushunt', BonusHuntController::class);
    Route::resource('bonushuntGame', BonusHuntGameController::class);
});



require __DIR__ . '/auth.php';

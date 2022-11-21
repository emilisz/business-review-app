<?php

use App\Domain\Controllers\BusinessController;
use App\Domain\Controllers\RatingController;
use App\Domain\Repositories\BusinessRepository;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::controller(BusinessController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/businesses/{business}', 'show')->name('business.show');

    Route::middleware(['auth'])->prefix('business')->group(function () {
        Route::get('/new', 'create')->name('business.create');
        Route::get('/{business}/edit', 'edit')->name('business.edit');
        Route::put('/{business}', 'update')->name('business.update');
        Route::post('/', 'store')->name('business.store');
        Route::delete('/{business}', 'delete')->name('business.delete');
    });
});

Route::middleware('auth')->controller(RatingController::class)->group(function () {
    Route::post('/businesses/{business}', 'store')->name('rating.store');
});


Route::get('/dashboard', function () {
    return view('dashboard')->with(['businesses' => (new BusinessRepository)->getAllByUser(auth()->id())]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

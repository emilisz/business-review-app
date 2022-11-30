<?php


use App\Domain\Repositories\BusinessRepository;
use App\Domain\Repositories\RatingRepository;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
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

Route::get('/', function (){
    return redirect()->route('home');
});

Route::controller(BusinessController::class)->group(function () {
    Route::get('/businesses', 'index')->name('home');
    Route::get('/businesses/orderby={order?}', 'orderby')->name('order');
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
    Route::post('/businesses/{business}/ratings', 'store')->name('rating.store');
    Route::delete('/businesses/{business}/ratings/{rating}', 'delete')->name('rating.delete');
});


Route::get('/dashboard', function () {
    $businesses = (new BusinessRepository)->getAllByUser(auth()->id());
    $ratings =    (new RatingRepository())->getAllByUser(auth()->id())->paginate(2);

    return view('dashboard', compact('businesses', 'ratings'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

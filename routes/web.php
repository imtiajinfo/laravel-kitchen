<?php

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



Auth::routes(['register'=> true]);

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::post('/reservation',[ReservationController::class, 'reserve'])->name('reservation.reserve');
Route::post('/contact', [ContactController::class, 'sendMessage'])->name('contact.send');


Route::group(['prefix'=> 'admin', 'middleware'=> 'auth'], function(){
	Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
	Route::resource('slider', SliderController::class);
	Route::resource('category', CategoryController::class);
	Route::resource('item', ItemController::class);

	Route::get('reservation', [ReservationController::class, 'index'])->name('reservation.index');
	Route::post('reservation/{id}', [ReservationController::class, 'status'])->name('reservation.status');
	Route::delete('reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');

	Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
	Route::get('contact/{id}', [ContactController::class, 'show'])->name('contact.show');
	Route::delete('contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
});

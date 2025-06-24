<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PolygonsController;
use App\Http\Controllers\PolylinesController;

Route::get('/', [PublicController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/polygons', [PolygonsController::class, 'index'])->name('polygons.index');
    Route::get('/polygons/create', [PolygonsController::class, 'create'])->name('polygons.create');
    Route::post('/polygons', [PolygonsController::class, 'store'])->name('polygons.store');
    Route::get('/polygons/{id}/edit', [PolygonsController::class, 'edit'])->name('polygons.edit');
    Route::put('/polygons/{id}', [PolygonsController::class, 'update'])->name('polygons.update');
    Route::delete('/polygons/{id}', [PolygonsController::class, 'destroy'])->name('polygons.destroy');

    //dari responsi
    Route::delete('/points/{id}', [PointsController::class, 'destroy'])->name('points.destroy');


});

Route::resource('points', PointsController::class);
Route::resource('polylines', PolylinesController::class);
Route::resource('polygons', PolygonsController::class);

Route::get('/map', [PointsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('map');

Route::get('/table', [TableController::class, 'index'])->name('table');


require __DIR__ . '/auth.php';

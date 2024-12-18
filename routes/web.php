<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'protectedAreas' => App\Models\ProtectedArea::with('species:common_name')->get(),
        'species' => App\Models\Specie::count(),
        'regions' => App\Models\Region::withCount('protectedArea')->get()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', fn () => Inertia::render('About'))->name('about');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('protectedAreas', App\Http\Controllers\ProtectedAreaController::class);
    Route::resource('specie', App\Http\Controllers\SpecieController::class);
    Route::post('updateSpecie', [App\Http\Controllers\SpecieController::class, 'updatespecie'])->name('updatespecie');

});

require __DIR__.'/auth.php';

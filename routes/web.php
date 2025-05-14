<?php

use App\Http\Controllers\LlistasController;
use App\Http\Controllers\AnuncioCicleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Cicles;
use App\Models\Familia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'familias' => Familia::all()
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return redirect()->route('cicles.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/cicles/buscar',[LlistasController::class,'search'])->name('cicles.buscar');

Route::resource('cicles', LlistasController::class)->middleware('auth');

Route::resource('anuncios', AnuncioCicleController::class);

require __DIR__.'/settings.php';

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\SubtareaController;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('proyectos', ProyectoController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);

    Route::resource('proyectos.tareas', TareaController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);

    Route::resource('tareas.subtareas', SubtareaController::class)
        ->only(['index', 'store', 'show', 'update', 'destroy']);
});

require __DIR__.'/auth.php';

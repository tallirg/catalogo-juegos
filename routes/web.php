<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\JuegoController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/menu', function() {
    return view('menu');
})->middleware('auth');

Route::get('/agregarJ', function() {
    return view('agregarJ');
});

Route::get('/carrito', function() {
    return view('carrito');
});

Route::get('/dashboard', function(){
    return redirect('/menu');
});

Route::post('/agregar-carrito', [CarritoController::class, 'agregar']);
Route::get('/carrito', [CarritoController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/menu', [JuegoController::class, 'menu']);

Route::get('/eliminar-carrito/{id}',
    [CarritoController::class, 'eliminar']);

Route::get('/pagar',
    [CarritoController::class, 'pagar']);

Route::get('/pago-exitoso', function(){

    App\Models\Carrito::where(
        'user_id',
        Auth::id()
    )->delete();

    return redirect('/menu')
        ->with('success',
        'Pago realizado correctamente');
});

require __DIR__.'/auth.php';

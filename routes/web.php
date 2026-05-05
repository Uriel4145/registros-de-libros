<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Redirige la página principal al listado de libros
Route::get('/', function () {
    return redirect()->route('books.index');
});

// GET  /libros → muestra el formulario y la tabla de libros
// POST /libros → procesa el formulario y guarda el libro
Route::get('/libros',  [BookController::class, 'index'])->name('books.index');
Route::post('/libros', [BookController::class, 'store'])->name('books.store');
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Usuario;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Livro;
use App\Models\Review;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ReviewController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UsuarioController::class)->group(function () {
    Route::post('/usuarios','store');
    Route::get('/usuarios','get');
    Route::get('/usuarios/{id}','details');
    Route::patch('/usuarios/{id}','update');
    Route::delete('/usuarios/{id}','delete');

    // Listar review de um usuário
    Route::get('/usuarios/reviews/{id}','reviewsDoUsuario');
});

Route::controller(AutorController::class)->group( function () {
    Route::post('/autores','store');
    Route::get('/autores','get');
    Route::patch('/autores/{id}','update');
    Route::delete('/autores/{id}','delete');

    // Listar todos os livros de um autor
    Route::get('/autores/livros/{id}','listarLivros');

    // Listar autores com seus livros
    Route::get('/autores/com-livros','autoresComLivros');

    Route::get('/autores/{id}','details');
});

Route::controller(GeneroController::class)->group( function () {
    Route::post('/generos','store');
    Route::get('/generos','get');
    Route::patch('/generos/{id}','update');
    Route::delete('/generos/{id}','delete');

    // Listar todos os livros de um gênero
    Route::get('/generos/livros/{id}','listarLivros');

    // Listar todos os gêneros com seus livros
    Route::get('/generos/com-livros','generosComLivros');

    Route::get('/generos/{id}','details');
});

Route::controller(LivroController::class)->group( function () {
    Route::post('/livros','store');
    Route::get('/livros','get');
    Route::patch('/livros/{id}','update');
    Route::delete('/livros/{id}','delete');
    
    # Listar Reviews de um livro
    Route::get('/livros/reviews/{id}','listarReviews');

    # Listar Livros com Reviews, Autor e Gênero
    Route::get('/livros/lista-completa','livrosCompletos');

    Route::get('/livros/{id}','details');
});

Route::controller(ReviewController::class)->group( function () {
    Route::post('/reviews','store');
    Route::get('/reviews','get');
    Route::get('/reviews/{id}','details');
    Route::patch('/reviews/{id}','update');
    Route::delete('/reviews/{id}','delete');
});

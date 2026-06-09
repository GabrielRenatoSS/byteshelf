<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecuperarSenhaController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate']);

// === Recuperação de senha (com código) ===
Route::get('/recuperacaosenha', [RecuperarSenhaController::class, 'create'])->name('password.request');
Route::post('/recuperacaosenha', [RecuperarSenhaController::class, 'enviarCodigo'])->name('password.send');

Route::get('/codigo-verificacao', [RecuperarSenhaController::class, 'codigoForm'])->name('codigo.form');
Route::post('/codigo-verificacao', [RecuperarSenhaController::class, 'verificarCodigo'])->name('codigo.verify');

Route::get('/nova-senha', [RecuperarSenhaController::class, 'novaSenhaForm'])->name('nova.senha.form');
Route::post('/nova-senha', [RecuperarSenhaController::class, 'redefinirSenha'])->name('nova.senha.update');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::get('/componente', [ComponenteController::class, 'index'])->name('componente.index');
    Route::get('/componente/{id}', [ComponenteController::class, 'show'])->name('componente.show');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
    Route::post('/carrinho/add/{id}', [CarrinhoController::class, 'adicionar'])->name('carrinho.add');
    Route::post('/carrinho/remove/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remove');
});

Route::middleware(['auth', 'IsAdmin'])->group(function () {
    Route::post('/user/{id}/bloqueio', [UserController::class, 'toggleBlock'])->name('user.block');
    Route::resource('categoria', CategoriaController::class);
    Route::resource('componente', ComponenteController::class);
});

Route::middleware(['auth', 'NotBlocked'])->group(function () {

});

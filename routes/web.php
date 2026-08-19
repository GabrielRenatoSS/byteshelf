<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecuperarSenhaController;
use App\Http\Controllers\PedidoController;

Route::get('/', function () {
    return view('login');
})->name('paglogin');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');
//Route::post('/users', [UserController::class, 'store'])->name('users.store');

Route::get('/auth/google', [UserController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');
//Route::post('/users', [UserController::class, 'store'])->name('users.store');

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

    Route::get('/pedidos/{id}/status', [PedidoController::class, 'verStatus'])->name('pedidos.status');

    Route::get('/pedidos/historico', [PedidoController::class, 'historico'])->name('pedidos.historico');
});

Route::middleware(['auth', 'IsAdmin'])->group(function () {

    Route::post('/user/{id}/bloqueio', [UserController::class, 'toggleBlock'])->name('user.block');
    Route::resource('categoria', CategoriaController::class);
    Route::resource('componente', ComponenteController::class);

    Route::post('/pedidos/{id}/aprovar', [PedidoController::class, 'aprovar']);
    Route::post('/pedidos/{id}/reprovar', [PedidoController::class, 'reprovar']);
    Route::post('/pedidos/{id}/sugerir', [PedidoController::class, 'sugerir']);
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

    Route::post('/pedidos/{id}/devolver', [PedidoController::class, 'devolver'])->name('pedidos.devolver');

    Route::get('/pedidos/devolvidos', [PedidoController::class, 'devolvidos'])->name('pedidos.devolvidos');
    Route::get('/pedidos/devolvidos/{id}', [PedidoController::class, 'detalheDevolvido'])->name('pedidos.detalheDevolvido');

    Route::get('/componentes/estragados', [ComponenteController::class, 'estragados'])->name('componentes.estragados');
});

Route::middleware(['auth', 'NotBlocked'])->group(function () {
    Route::post('/pedidos/{id}/aceitar-sugestao', [PedidoController::class, 'aceitarSugestao']);
    Route::post('/pedidos/{id}/recusar-sugestao', [PedidoController::class, 'recusarSugestao']);
    Route::post('/pedidos/finalizar', [PedidoController::class, 'finalizarPedido'])->name('pedidos.finalizar');
    Route::post('/pedidos/{id}/renovar', [PedidoController::class, 'renovar'])->name('pedidos.renovar');
});

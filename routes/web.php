<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecuperarSenhaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MensagemEmailController;
use App\Http\Controllers\RegulamentoController;

/*
|--------------------------------------------------------------------------
| Rotas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('login');
})->name('paglogin');

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

/*
|--------------------------------------------------------------------------
| Cadastro
|--------------------------------------------------------------------------
*/

Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');

// Route::post('/users', [UserController::class, 'store'])->name('users.store');

/*
|--------------------------------------------------------------------------
| Usuários público temporário para teste
|--------------------------------------------------------------------------
| Essa rota está fora do middleware auth/admin para testar o frontend.
*/

Route::get('/users', [UserController::class, 'index'])->name('users.index');

/*
|--------------------------------------------------------------------------
| Login com Google
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [UserController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback'])->name('google.callback');

/*
|--------------------------------------------------------------------------
| Recuperação de senha
|--------------------------------------------------------------------------
*/

Route::get('/recuperacaosenha', [RecuperarSenhaController::class, 'create'])->name('password.request');
Route::post('/recuperacaosenha', [RecuperarSenhaController::class, 'enviarCodigo'])->name('password.send');

Route::get('/codigo-verificacao', [RecuperarSenhaController::class, 'codigoForm'])->name('codigo.form');
Route::post('/codigo-verificacao', [RecuperarSenhaController::class, 'verificarCodigo'])->name('codigo.verify');

Route::get('/nova-senha', [RecuperarSenhaController::class, 'novaSenhaForm'])->name('nova.senha.form');
Route::post('/nova-senha', [RecuperarSenhaController::class, 'redefinirSenha'])->name('nova.senha.update');

/*
|--------------------------------------------------------------------------
| Enviar mensagem por e-mail
|--------------------------------------------------------------------------
*/

Route::get('/enviar-mensagem', [MensagemEmailController::class, 'form'])->name('mensagens.form');
Route::post('/enviar-mensagem', [MensagemEmailController::class, 'enviar'])->name('mensagens.enviar');

/*
|--------------------------------------------------------------------------
| Rotas para usuário logado
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::resource('users', UserController::class)->except(['index']);

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

    Route::get('/regulamento', [RegulamentoController::class, 'show'])->name('regulamento.show');
    Route::post('/regulamento/aceitar', [UserController::class, 'aceitarRegulamento'])->name('regulamento.aceitar');

    Route::get('/contato-administradores', [UserController::class, 'verContatoAdm'])->name('users.adms');
});

/*
|--------------------------------------------------------------------------
| Rotas de administrador
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'IsAdmin'])->group(function () {

    // A rota /users foi movida temporariamente para fora do admin para teste.
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::post('/user/{id}/bloqueio', [UserController::class, 'toggleBlock'])->name('user.block');

    Route::resource('categoria', CategoriaController::class);
    Route::resource('componente', ComponenteController::class);

    Route::post('/pedidos/{id}/aprovar', [PedidoController::class, 'aprovar'])->name('pedidos.aprovar');
    Route::post('/pedidos/{id}/reprovar', [PedidoController::class, 'reprovar'])->name('pedidos.reprovar');
    Route::post('/pedidos/{id}/sugerir', [PedidoController::class, 'sugerir'])->name('pedidos.sugerir');

    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');

    Route::post('/pedidos/{id}/devolver', [PedidoController::class, 'devolver'])->name('pedidos.devolver');

    Route::get('/pedidos/devolvidos', [PedidoController::class, 'devolvidos'])->name('pedidos.devolvidos');
    Route::get('/pedidos/devolvidos/{id}', [PedidoController::class, 'detalheDevolvido'])->name('pedidos.detalheDevolvido');

    Route::get('/componentes/estragados', [ComponenteController::class, 'estragados'])->name('componentes.estragados');

    Route::get('/pedidos/minhas-reservas', [PedidoController::class, 'reservas'])->name('pedidos.reservas');
    Route::post('/pedidos/reservas/{id}/devolver', [PedidoController::class, 'devolverReserva'])->name('pedidos.reservas.devolver');

    Route::get('/admin/regulamento/editar', [RegulamentoController::class, 'edit'])->name('admin.regulamento.edit');
    Route::put('/admin/regulamento', [RegulamentoController::class, 'update'])->name('admin.regulamento.update');
});

/*
|--------------------------------------------------------------------------
| Rotas de usuário não bloqueado
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'NotBlocked'])->group(function () {

    Route::post('/pedidos/{id}/aceitar-sugestao', [PedidoController::class, 'aceitarSugestao'])->name('pedidos.aceitarSugestao');
    Route::post('/pedidos/{id}/recusar-sugestao', [PedidoController::class, 'recusarSugestao'])->name('pedidos.recusarSugestao');

    Route::post('/pedidos/finalizar', [PedidoController::class, 'finalizarPedido'])->name('pedidos.finalizar');
    Route::post('/pedidos/{id}/renovar', [PedidoController::class, 'renovar'])->name('pedidos.renovar');
});
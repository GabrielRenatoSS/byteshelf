<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byteshelf - Gerenciamento</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}?v=10">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}?v=10">
</head>

<body>

<header class="top-nav">
    <div class="logo-container">
        <img src="{{ asset('assets/logo_retangular_azul.jpeg') }}" alt="Byteshelf" class="main-logo">
    </div>

    <div class="nav-icons">
        <i class="fa-solid fa-house" onclick="home()" title="Início" style="cursor: pointer;"></i>
        <i class="fa-solid fa-right-from-bracket" onclick="sair()" title="Sair" style="cursor: pointer;"></i>
        <i class="fa-solid fa-book-open" onclick="catalogo()" title="Catálogo" style="cursor: pointer;"></i>
        <i class="fa-solid fa-user" onclick="perfil()" title="Perfil" style="cursor: pointer;"></i>
        <i class="fa-solid fa-cart-shopping" onclick="carrinho()" title="Carrinho" style="cursor: pointer;"></i>
    </div>
</header>

<div class="container">
    <aside class="sidebar">
        <h2>Olá, Leandro!</h2>

        <nav>
            <ul id="menu-sidebar">
                <li>
                    <i class="fa-regular fa-user"></i> Dados Pessoais
                </li>

                <li>
                    <i class="fa-solid fa-box-open"></i> Pedidos
                </li>

                <li>
                    <i class="fa-regular fa-bell"></i> Notificações
                </li>

                <li>
                    <i class="fa-regular fa-calendar-check"></i> Minhas reservas
                </li>

                <li class="active">
                    <i class="fa-solid fa-users"></i> Usuários
                </li>

                <li>
                    <i class="fa-regular fa-file-lines"></i> Regulamento
                </li>

                <li onclick="window.location.href='{{ route('mensagens.form') }}'">
                    <i class="fa-regular fa-envelope"></i> Enviar mensagem
                </li>

                <li>
                    <i class="fa-regular fa-heart"></i> Doações
                </li>

                <li>
                    <i class="fa-solid fa-chart-line"></i> Relatórios
                </li>
            </ul>
        </nav>
    </aside>

    <main class="content">
        <div class="content-header">
            <h1>Usuários</h1>

            <button class="add-btn" onclick="window.location.href='{{ route('cadastro') }}'">
                +
            </button>
        </div>

        <div class="user-list">
            @forelse($users as $user)
                <div class="user-row">
                    <div class="user-info">
                        <div class="avatar">
                            @if($user['foto'])
                                <img src="{{ $user['foto'] }}" alt="Foto de {{ $user['name'] }}" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            @else
                                <i class="fa-solid fa-user"></i>
                            @endif
                        </div>

                        <div>
                            <p class="user-name">{{ $user['name'] }}</p>
                            <p class="id-number">ID: {{ $user['matricula'] ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="actions">
                        <!-- Botão Bloquear / Desbloquear -->
                        <form action="{{ route('user.block', $user['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button class="btn-action {{ $user['bloqueio'] == 1 ? 'bloqueado' : '' }}" type="submit" title="{{ $user['bloqueio'] == 1 ? 'Desbloquear' : 'Bloquear' }}">
                                @if($user['bloqueio'] == 1)
                                    <i class="fa-solid fa-unlock"></i>
                                @else
                                    <i class="fa-solid fa-ban"></i>
                                @endif
                            </button>
                        </form>

                        <!-- Botão Enviar Mensagem -->
                        <button class="btn-action" type="button" onclick="prepararMensagem('{{ $user['email'] }}')" title="Enviar Mensagem">
                            <i class="fa-regular fa-envelope"></i>
                        </button>

                        <!-- Botão Excluir -->
                        <form action="{{ route('users.destroy', $user['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja remover {{ $user['name'] }}?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn-action" type="submit" title="Excluir">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="orders-empty" style="padding: 20px; text-align: center;">Nenhum usuário cadastrado.</p>
            @endforelse
        </div>
    </main>
</div>

<div id="modal-confirmacao" class="modal">
    <div class="modal-content">
        <h3 id="modal-titulo">Título</h3>
        <p id="modal-texto">Texto</p>

        <div class="modal-buttons">
            <button onclick="fecharModal()" class="btn-cancelar">Cancelar</button>
            <button onclick="confirmarAcao()" class="btn-confirmar">Confirmar</button>
        </div>
    </div>
</div>

<script src="{{ asset('js/perfil.js') }}?v=10"></script>

</body>
</html>
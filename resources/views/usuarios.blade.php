<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byteshelf - Gerenciamento</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
</head>
<body>

    <header class="top-nav">
        <div class="logo-container">
            <img src="{{ asset('assets/logo_retangular_azul.jpeg') }}" alt="Byteshelf" class="main-logo">
        </div>
        <div class="nav-icons">
            <!-- INÍCIO -->
            <i class="fa-solid fa-house" onclick="window.location.href='{{ route('inicio') }}'" title="Início"></i>

            <!-- SAIR -->
            @auth
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <i class="fa-solid fa-right-from-bracket" onclick="document.getElementById('logout-form').submit()" title="Sair"></i>
            @endauth

            <!-- CATÁLOGO -->
            <i class="fa-solid fa-book-open" onclick="window.location.href='{{ route('catalogo') }}'" title="Catálogo"></i>

            <!-- PERFIL -->
            <i class="fa-solid fa-user" onclick="window.location.href='{{ route('perfil') }}'" title="Perfil"></i>

            <!-- CARRINHO -->
            <i class="fa-solid fa-cart-shopping" onclick="carrinho()" title="Carrinho"></i>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <h2>Olá, {{ auth()->user()->name ?? 'Usuário' }}!</h2>
            <nav>
                <ul id="menu-sidebar">
                    <li><i class="fa-regular fa-user"></i> Dados Pessoais</li>
                    <li><i class="fa-solid fa-box-open"></i> Pedidos</li>
                    <li><i class="fa-regular fa-bell"></i> Notificações</li>
                    <li><i class="fa-regular fa-calendar-check"></i> Minhas reservas</li>
                    <li class="active"><i class="fa-solid fa-users"></i> Usuários</li>
                    <li><i class="fa-regular fa-file-lines"></i> Regulamento</li>
                    <li><i class="fa-regular fa-envelope"></i> Enviar mensagem</li>
                    <li><i class="fa-regular fa-heart"></i> Doações</li>
                    <li><i class="fa-solid fa-chart-line"></i> Relatórios</li>
                </ul>
            </nav>
        </aside>

        <main class="content">
            <div class="content-header">
                <h1>Usuários</h1>
                <button class="add-btn" onclick="window.location.href='{{ route('cadastro') }}'">+</button>
            </div>

            <div class="user-list">
                @forelse($users as $user)
                    <div class="user-row">
                        <!-- DADOS DO USUÁRIO -->
                        <div class="user-info">
                            <div class="avatar">
                                <img src="{{ $user['foto'] ?? asset('fotos_usuarios/foto.jpg') }}" 
                                alt="{{ $user['name'] }}" 
                                style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            </div>
                            <div>
                                <p class="user-name">{{ $user['name'] }}</p>
                                <p class="id-number">{{ $user['email'] }}</p>                            </div>
                        </div>

                        <!-- AÇÕES (BLOQUEAR / MENSAGEM / EXCLUIR) -->
                        <div class="actions">
                            <!-- Formulário de Bloqueio -->
                            <!-- Botão de Bloqueio/Desbloqueio -->
<form id="form-block-{{ $user['id'] }}" action="{{ route('user.block', $user['id']) }}" method="POST" style="display: inline;">
    @csrf
    <button type="button" 
            class="btn-action {{ $user['bloqueio'] == 1 ? 'bloqueado' : '' }}" 
            onclick="abrirModal('bloquear', '{{ $user['name'] }}', this)" 
            title="{{ $user['bloqueio'] == 1 ? 'Desbloquear' : 'Bloquear' }}">
        <i class="fa-solid {{ $user['bloqueio'] == 1 ? 'fa-unlock' : 'fa-ban' }}"></i>
    </button>
</form>

                            <!-- Enviar Mensagem -->
                            <button class="btn-action" onclick="prepararMensagem('{{ $user['email'] }}')" title="Enviar Mensagem">
                                <i class="fa-regular fa-envelope"></i>
                            </button>

                            <!-- Excluir Usuário -->
                            <button class="btn-action" onclick="abrirModal('excluir', '{{ $user['name'] }}', this)" title="Excluir Usuário">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: #666; padding: 20px;">Nenhum usuário cadastrado.</p>
                @endforelse

                <!-- PAGINAÇÃO -->
                <div class="pagination-container" style="margin-top: 20px;">
                    {{ $users->links() }}
                </div>
            </div>
        </main>
    </div>

    <!-- MODAL DE CONFIRMAÇÃO -->
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

    <script src="{{ asset('js/perfil.js') }}"></script>
</body>
</html>
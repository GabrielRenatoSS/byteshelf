<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byteshelf - Enviar Mensagem</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}?v=11">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}?v=11">
</head>

<body>

<header class="top-nav">
    <div class="logo-container">
        <img src="{{ asset('assets/logo_retangular_azul.jpeg') }}" alt="Byteshelf" class="main-logo">
    </div>

    <div class="nav-icons">
        <i class="fa-solid fa-house" onclick="window.location.href='{{ route('home') }}'" style="cursor: pointer;"></i>
        <i class="fa-solid fa-right-from-bracket" onclick="sair()" style="cursor: pointer;"></i>
        <i class="fa-solid fa-book-open" onclick="window.location.href='{{ route('componente.index') }}'" style="cursor: pointer;"></i>
        <i class="fa-solid fa-user" onclick="window.location.href='{{ route('users.index') }}'" style="cursor: pointer;"></i>
        <i class="fa-solid fa-cart-shopping" onclick="window.location.href='{{ route('carrinho.index') }}'" style="cursor: pointer;"></i>
    </div>
</header>

<div class="container">

    <aside class="sidebar">
        <h2>Olá, Leandro!</h2>

        <nav>
            <ul id="menu-sidebar">
                <li><i class="fa-regular fa-user"></i> Dados Pessoais</li>
                <li><i class="fa-solid fa-box-open"></i> Pedidos</li>
                <li><i class="fa-regular fa-bell"></i> Notificações</li>
                <li><i class="fa-regular fa-calendar-check"></i> Minhas reservas</li>

                <li onclick="window.location.href='{{ route('users.index') }}'" style="cursor: pointer;">
                    <i class="fa-solid fa-users"></i> Usuários
                </li>

                <li><i class="fa-regular fa-file-lines"></i> Regulamento</li>

                <li class="active">
                    <i class="fa-regular fa-envelope"></i> Enviar mensagem
                </li>

                <li><i class="fa-regular fa-heart"></i> Doações</li>
                <li><i class="fa-solid fa-chart-line"></i> Relatórios</li>
            </ul>
        </nav>
    </aside>

    <main class="content">
        <h1>Enviar mensagem</h1>

        <section class="message-container">
            <div class="message-card">

                @if (session('status'))
                    <p class="success-message">{{ session('status') }}</p>
                @endif

                @if ($errors->any())
                    <p style="color: red; margin-bottom: 15px;">
                        {{ $errors->first() }}
                    </p>
                @endif

                <form method="POST" action="{{ route('mensagens.enviar') }}">
                    @csrf

                    <div class="input-group">
                        <label>Destinatário:</label>
                        <input
                            type="email"
                            name="email"
                            value="{{ request('email') }}"
                            placeholder="usuario@aluno.iffar.edu.br"
                            required
                        >
                    </div>

                    <div class="input-group">
                        <label>Assunto:</label>
                        <input
                            type="text"
                            name="assunto"
                            value="{{ old('assunto') }}"
                            placeholder="Assunto da mensagem"
                            required
                        >
                    </div>

                    <div class="input-group">
                        <label>Mensagem:</label>
                        <textarea
                            name="mensagem"
                            placeholder="Escreva aqui sua mensagem..."
                            required
                        >{{ old('mensagem') }}</textarea>
                    </div>

                    <div class="button-area">
                        <button type="submit" class="btn-send">
                            Enviar mensagem
                        </button>
                    </div>
                </form>

            </div>
        </section>
    </main>

</div>

<form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
    @csrf
</form>

<script>
    function sair() {
        const form = document.getElementById('logout-form');

        if (form) {
            form.submit();
        } else {
            window.location.href = "{{ route('login') }}";
        }
    }
</script>

</body>
</html>
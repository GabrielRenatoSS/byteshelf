<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Regulamento</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/regulamento.css') }}">
</head>
<body>
    <header class="top-nav">
        <div class="logo-container">
            <img src="../assets/logo_retangular_azul.jpeg" alt="ByteShelf" class="main-logo">
        </div>
        <div class="nav-icons">
            <i class="fa-solid fa-house" onclick="home()" title="Início"></i>
            <i class="fa-solid fa-right-from-bracket" onclick="sair()" title="Sair"></i>
            <i class="fa-solid fa-book-open" onclick="catalogo()" title="Catálogo"></i>
            <i class="fa-solid fa-user" onclick="perfil()" title="Perfil"></i>
            <i class="fa-solid fa-cart-shopping" onclick="carrinho()" title="Carrinho"></i>
        </div>
    </header>

    <div class="container regulation-page-container">
        <aside class="sidebar">
            <h2 data-administrator-greeting>Olá!</h2>
            <nav>
                <ul id="menu-sidebar">
                    <li onclick="dadosPessoais()"><i class="fa-regular fa-user"></i> Dados Pessoais</li>
                    <li onclick="pedidos()"><i class="fa-solid fa-box-open"></i> Pedidos</li>
                    <li><i class="fa-regular fa-bell"></i> Notificações</li>
                    <li onclick="reservas()"><i class="fa-regular fa-calendar-check"></i> Minhas reservas</li>
                    <li onclick="usuarios()"><i class="fa-solid fa-users"></i> Usuários</li>
                    <li class="active"><i class="fa-regular fa-file-lines"></i> Regulamento</li>
                    <li onclick="abrirEnviarMensagem()"><i class="fa-regular fa-envelope"></i> Enviar mensagem</li>
                    <li><i class="fa-regular fa-heart"></i> Doações</li>
                    <li><i class="fa-solid fa-chart-line"></i> Relatórios</li>
                </ul>
            </nav>
        </aside>

        <main class="content regulation-content">
            <div class="regulation-header">
                <h1>Regulamento</h1>
                <button type="button" class="edit-regulation-button" id="edit-regulation-button" onclick="editarRegulamento()">
                    <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                    <span>EDITAR</span>
                </button>
            </div>

            <section class="regulation-card" id="regulation-card" aria-live="polite"></section>
        </main>
    </div>

    <script src="{{ asset('js/regulamento.js') }}"></script>
</body>
</html>

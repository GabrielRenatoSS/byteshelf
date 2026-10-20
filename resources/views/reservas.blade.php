<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Minhas reservas</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reservas.css') }}">
</head>
<body>
    <header class="top-nav">
        <div class="logo-container"><img src="../assets/logo_retangular_azul.jpeg" alt="ByteShelf" class="main-logo"></div>
        <div class="nav-icons">
            <i class="fa-solid fa-house" onclick="home()" title="Início"></i>
            <i class="fa-solid fa-right-from-bracket" onclick="sair()" title="Sair"></i>
            <i class="fa-solid fa-book-open" onclick="catalogo()" title="Catálogo"></i>
            <i class="fa-solid fa-user" onclick="perfil()" title="Perfil"></i>
            <i class="fa-solid fa-cart-shopping" onclick="carrinho()" title="Carrinho de reservas"></i>
        </div>
    </header>

    <div class="container reservations-page-container">
        <aside class="sidebar">
            <h2 data-administrator-greeting>Olá!</h2>
            <nav>
                <ul id="menu-sidebar">
                    <li onclick="dadosPessoais()"><i class="fa-regular fa-user"></i> Dados Pessoais</li>
                    <li onclick="pedidos()"><i class="fa-solid fa-box-open"></i> Pedidos</li>
                    <li><i class="fa-regular fa-bell"></i> Notificações</li>
                    <li class="active"><i class="fa-regular fa-calendar-check"></i> Minhas reservas</li>
                    <li onclick="usuarios()"><i class="fa-solid fa-users"></i> Usuários</li>
                    <li onclick="regulamento()"><i class="fa-regular fa-file-lines"></i> Regulamento</li>
                    <li onclick="abrirEnviarMensagem()"><i class="fa-regular fa-envelope"></i> Enviar mensagem</li>
                    <li><i class="fa-regular fa-heart"></i> Doações</li>
                    <li><i class="fa-solid fa-chart-line"></i> Relatórios</li>
                </ul>
            </nav>
        </aside>

        <main class="content reservations-content">
            <div class="reservations-header">
                <h1>Minhas reservas</h1>
                <div class="orders-tool-wrap">
                    <button type="button" class="orders-icon-button" id="sort-reservations-button" title="Ordenar reservas" aria-label="Ordenar reservas" aria-expanded="false">
                        <i class="fa-solid fa-sliders" aria-hidden="true"></i>
                    </button>
                    <div class="orders-popover orders-popover--sort" id="sort-reservations-menu" hidden>
                        <button type="button" data-reservation-sort="recent" class="is-active">Mais recentes</button>
                        <button type="button" data-reservation-sort="oldest">Mais antigas</button>
                    </div>
                </div>
            </div>
            <section id="reservations-list" class="reservations-list" aria-live="polite"></section>
        </main>
    </div>

    <div class="order-modal" id="reservation-return-modal" aria-hidden="true">
        <section class="order-modal-card order-modal-card--confirm" role="dialog" aria-modal="true" aria-labelledby="reservation-return-title">
            <h2 id="reservation-return-title">Você tem certeza que deseja devolver esta reserva?</h2>
            <div class="order-modal-actions">
                <button type="button" id="confirm-reservation-return" class="order-action-button order-action-button--blue"><i class="fa-solid fa-reply" aria-hidden="true"></i> DEVOLVER</button>
                <button type="button" class="order-action-button order-action-button--blue" data-close-reservation-modal><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> VOLTAR</button>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/reservas.js') }}"></script>
</body>
</html>

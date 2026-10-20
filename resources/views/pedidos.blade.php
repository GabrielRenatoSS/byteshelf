<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Pedidos</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
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

    <div class="container orders-page-container">
        <aside class="sidebar">
            <h2 data-administrator-greeting>Olá!</h2>
            <nav>
                <ul id="menu-sidebar">
                    <li onclick="dadosPessoais()"><i class="fa-regular fa-user"></i> Dados Pessoais</li>
                    <li class="active"><i class="fa-solid fa-box-open"></i> Pedidos</li>
                    <li><i class="fa-regular fa-bell"></i> Notificações</li>
                    <li onclick="reservas()"><i class="fa-regular fa-calendar-check"></i> Minhas reservas</li>
                    <li onclick="usuarios()"><i class="fa-solid fa-users"></i> Usuários</li>
                    <li onclick="regulamento()"><i class="fa-regular fa-file-lines"></i> Regulamento</li>
                    <li onclick="abrirEnviarMensagem()"><i class="fa-regular fa-envelope"></i> Enviar mensagem</li>
                    <li><i class="fa-regular fa-heart"></i> Doações</li>
                    <li><i class="fa-solid fa-chart-line"></i> Relatórios</li>
                </ul>
            </nav>
        </aside>

        <main class="content orders-content">
            <div class="orders-header">
                <h1>Pedidos</h1>
                <div class="orders-tools">
                    <div class="orders-tool-wrap">
                        <button type="button" class="orders-icon-button" id="status-filter-button" title="Filtrar por status" aria-label="Filtrar por status" aria-expanded="false">
                            <i class="fa-solid fa-filter" aria-hidden="true"></i>
                        </button>
                        <div class="orders-popover" id="status-filter-menu" hidden>
                            <button type="button" data-status-filter="Todos" class="is-active">Todos</button>
                            <button type="button" data-status-filter="Solicitado">Solicitado</button>
                            <button type="button" data-status-filter="Aprovado">Aprovado</button>
                            <button type="button" data-status-filter="Negado">Negado</button>
                            <button type="button" data-status-filter="Em separação">Em separação</button>
                            <button type="button" data-status-filter="Pronto para retirada">Pronto para retirada</button>
                            <button type="button" data-status-filter="Retirado">Retirado</button>
                            <button type="button" data-status-filter="Devolvido">Devolvido</button>
                            <button type="button" data-status-filter="Sugestão em aberto">Sugestão em aberto</button>
                        </div>
                    </div>
                    <div class="orders-tool-wrap">
                        <button type="button" class="orders-icon-button" id="sort-orders-button" title="Ordenar pedidos" aria-label="Ordenar pedidos" aria-expanded="false">
                            <i class="fa-solid fa-sliders" aria-hidden="true"></i>
                        </button>
                        <div class="orders-popover orders-popover--sort" id="sort-orders-menu" hidden>
                            <button type="button" data-order-sort="recent" class="is-active">Mais recentes</button>
                            <button type="button" data-order-sort="oldest">Mais antigos</button>
                            <button type="button" data-order-sort="name">Nome do usuário</button>
                        </div>
                    </div>
                </div>
            </div>

            <section id="orders-list" class="orders-list" aria-live="polite"></section>
        </main>
    </div>

    <script src="{{ asset('js/pedidos.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Meus pedidos</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/meus_pedidos.css') }}">
</head>
<body>
    <header class="top-nav">
        <div class="logo-container"><img src="../assets/logo_retangular_azul.jpeg" alt="ByteShelf" class="main-logo"></div>
        <div class="nav-icons">
            <i class="fa-solid fa-house" onclick="home()" title="Início"></i>
            <i class="fa-solid fa-right-from-bracket" onclick="sair()" title="Sair"></i>
            <i class="fa-solid fa-book-open" onclick="catalogo()" title="Catálogo"></i>
            <i class="fa-solid fa-user" onclick="perfil()" title="Perfil"></i>
            <i class="fa-solid fa-cart-shopping" onclick="carrinho()" title="Carrinho de empréstimos"></i>
        </div>
    </header>

    <div class="container common-orders-page-container">
        <aside class="sidebar">
            <h2 data-common-user-greeting>Olá!</h2>
            <nav>
                <ul id="menu-sidebar">
                    <li onclick="dadosPessoais()"><i class="fa-regular fa-user"></i> Dados Pessoais</li>
                    <li class="active"><i class="fa-solid fa-box-open"></i> Meus pedidos</li>
                    <li><i class="fa-regular fa-bell"></i> Notificações</li>
                    <li><i class="fa-regular fa-calendar"></i> Prazos</li>
                    <li><i class="fa-regular fa-heart"></i> Propor doação</li>
                    <li><i class="fa-regular fa-comments"></i> Contate-nos</li>
                    <li onclick="regulamento()"><i class="fa-regular fa-file-lines"></i> Regulamento</li>
                </ul>
            </nav>
        </aside>

        <main class="content common-orders-content">
            <div class="common-orders-header">
                <h1>Pedidos</h1>
                <div class="common-orders-tools" aria-label="Ferramentas dos pedidos">
                    <div class="common-orders-tool-wrap">
                        <button type="button" class="common-orders-icon-button" id="common-filter-button" title="Filtrar pedidos" aria-label="Filtrar pedidos" aria-expanded="false">
                            <i class="fa-solid fa-filter" aria-hidden="true"></i>
                        </button>
                        <div class="common-orders-popover" id="common-filter-menu" hidden>
                            <p>Filtrar por:</p>
                            <button type="button" data-common-filter="all" class="is-active">Todos os pedidos</button>
                            <button type="button" data-common-filter="active">Pedidos ativos</button>
                            <button type="button" data-common-filter="returned">Pedidos devolvidos</button>
                            <button type="button" data-common-filter="denied">Pedidos negados</button>
                        </div>
                    </div>
                    <div class="common-orders-tool-wrap">
                        <button type="button" class="common-orders-icon-button" id="common-sort-button" title="Ordenar pedidos" aria-label="Ordenar pedidos" aria-expanded="false">
                            <i class="fa-solid fa-sliders" aria-hidden="true"></i>
                        </button>
                        <div class="common-orders-popover" id="common-sort-menu" hidden>
                            <p>Ordenar por:</p>
                            <button type="button" data-common-sort="recent" class="is-active">Mais recente</button>
                            <button type="button" data-common-sort="oldest">Menos recente</button>
                        </div>
                    </div>
                </div>
            </div>

            <section id="common-orders-list" class="common-orders-list" aria-live="polite"></section>
        </main>
    </div>

    <div class="common-order-modal" id="common-status-modal" aria-hidden="true">
        <section class="common-order-modal-card common-status-modal-card" role="dialog" aria-modal="true" aria-labelledby="common-status-title">
            <button type="button" class="common-modal-close" data-close-common-modal aria-label="Fechar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
            <h2 id="common-status-title">Status do pedido</h2>
            <div id="common-status-steps" class="common-status-steps"></div>
            <p id="common-status-message" class="common-status-message" hidden></p>
        </section>
    </div>

    <script src="{{ asset('js/meus_pedidos.js') }}"></script>
</body>
</html>

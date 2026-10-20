<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Pedido</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/meus_pedidos.css') }}">
</head>
<body class="common-order-detail-body">
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

    <main class="common-order-detail-page">
        <button type="button" class="common-order-back-button" onclick="voltarPedidos()" aria-label="Voltar para meus pedidos"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></button>
        <section id="common-order-detail" class="common-order-detail-card" aria-live="polite"></section>
    </main>

    <div class="common-order-modal" id="common-confirm-modal" aria-hidden="true">
        <section class="common-order-modal-card common-confirm-modal-card" role="dialog" aria-modal="true" aria-labelledby="common-confirm-title">
            <h2 id="common-confirm-title">Deseja confirmar esta ação?</h2>
            <p id="common-confirm-description" class="common-confirm-description"></p>
            <div class="common-modal-actions">
                <button type="button" id="common-confirm-action" class="common-action-button common-action-button--blue">CONFIRMAR</button>
                <button type="button" class="common-action-button common-action-button--neutral" data-close-common-modal>VOLTAR</button>
            </div>
        </section>
    </div>

    <div class="common-order-modal" id="common-suggestion-modal" aria-hidden="true">
        <section class="common-order-modal-card common-suggestion-modal-card" role="dialog" aria-modal="true" aria-labelledby="common-suggestion-title">
            <button type="button" class="common-modal-close" data-close-common-modal aria-label="Fechar"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
            <h2 id="common-suggestion-title">Sugestão do administrador</h2>
            <p id="common-suggestion-text" class="common-suggestion-text"></p>
            <div class="common-modal-actions">
                <button type="button" id="accept-suggestion" class="common-action-button common-action-button--blue">ACEITAR SUGESTÃO</button>
                <button type="button" id="reject-suggestion" class="common-action-button common-action-button--neutral">RECUSAR</button>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/meus_pedidos.js') }}"></script>
</body>
</html>

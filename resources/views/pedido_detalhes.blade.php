<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Pedido</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">
</head>
<body class="order-detail-body">
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

    <main class="order-detail-page">
        <button type="button" class="order-back-button" onclick="voltarPedidos()" aria-label="Voltar para pedidos"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></button>
        <section id="order-detail" class="order-detail-card" aria-live="polite"></section>
    </main>

    <div class="order-modal" id="status-confirm-modal" aria-hidden="true">
        <section class="order-modal-card order-modal-card--confirm" role="dialog" aria-modal="true" aria-labelledby="status-confirm-title">
            <h2 id="status-confirm-title">Você tem certeza que deseja mudar o status do pedido?</h2>
            <div class="order-modal-actions">
                <button type="button" id="confirm-status-change" class="order-action-button"></button>
                <button type="button" class="order-action-button order-action-button--blue" data-close-modal><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> VOLTAR</button>
            </div>
        </section>
    </div>

    <div class="order-modal" id="reject-order-modal" aria-hidden="true">
        <section class="order-modal-card" role="dialog" aria-modal="true" aria-labelledby="reject-order-title">
            <h2 id="reject-order-title">Escreva o motivo da recusa:</h2>
            <textarea id="reject-reason" maxlength="400" placeholder="Explique ao usuário o motivo da recusa..."></textarea>
            <div class="order-modal-actions">
                <button type="button" id="confirm-rejection" class="order-action-button order-action-button--red">RECUSAR PEDIDO</button>
                <button type="button" class="order-action-button order-action-button--blue" data-close-modal><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> VOLTAR</button>
            </div>
        </section>
    </div>

    <div class="order-modal" id="suggestion-modal" aria-hidden="true">
        <section class="order-modal-card" role="dialog" aria-modal="true" aria-labelledby="suggestion-title">
            <h2 id="suggestion-title">Escreva a sugestão de alteração:</h2>
            <textarea id="suggestion-text" maxlength="400" placeholder="Descreva a alteração sugerida para este pedido..."></textarea>
            <div class="order-modal-actions">
                <button type="button" id="confirm-suggestion" class="order-action-button order-action-button--orange">ENVIAR SUGESTÃO</button>
                <button type="button" class="order-action-button order-action-button--blue" data-close-modal><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> VOLTAR</button>
            </div>
        </section>
    </div>

    <div class="order-modal" id="return-order-modal" aria-hidden="true">
        <section class="order-modal-card" role="dialog" aria-modal="true" aria-labelledby="return-order-title">
            <h2 id="return-order-title">Se houve algum problema na devolução, registre-o abaixo:</h2>
            <textarea id="return-note" maxlength="400" placeholder="O pedido foi entregue com atraso..."></textarea>
            <div class="order-modal-actions">
                <button type="button" id="confirm-return" class="order-action-button order-action-button--orange">MARCAR PEDIDO COMO DEVOLVIDO</button>
                <button type="button" class="order-action-button order-action-button--blue" data-close-modal><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> VOLTAR</button>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/pedidos.js') }}"></script>
</body>
</html>

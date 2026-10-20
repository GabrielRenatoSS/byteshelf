<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Visualizar usuário</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/visualizar_usuario.css') }}">
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

    <main class="user-view-page">
        <button type="button" class="back-button" onclick="voltarUsuarios()" aria-label="Voltar para usuários" title="Voltar">
            <i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i>
        </button>

        <section class="user-details-card" id="user-details-card" aria-live="polite"></section>
        <section class="user-history-card" id="user-history-card" aria-live="polite" hidden></section>
    </main>

    <script src="{{ asset('js/visualizar_usuario.js') }}"></script>
</body>
</html>

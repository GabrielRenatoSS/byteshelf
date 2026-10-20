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
            <i class="fa-solid fa-cart-shopping" onclick="carrinho()" title="Carrinho de empréstimos"></i>
        </div>
    </header>

    <div class="container regulation-page-container">
        <aside class="sidebar">
            <h2 data-common-user-greeting>Olá!</h2>
            <nav>
                <ul id="menu-sidebar">
                    <li onclick="dadosPessoais()"><i class="fa-regular fa-user"></i> Dados Pessoais</li>
                    <li onclick="meusPedidos()"><i class="fa-solid fa-box-open"></i> Meus pedidos</li>
                    <li><i class="fa-regular fa-bell"></i> Notificações</li>
                    <li><i class="fa-regular fa-calendar"></i> Prazos</li>
                    <li><i class="fa-regular fa-heart"></i> Propor doação</li>
                    <li><i class="fa-regular fa-comments"></i> Contate-nos</li>
                    <li class="active"><i class="fa-regular fa-file-lines"></i> Regulamento</li>
                </ul>
            </nav>
        </aside>

        <main class="content regulation-content">
            <div class="regulation-header">
                <h1>Regulamento</h1>
            </div>
            <section class="regulation-card" id="regulation-card" aria-live="polite"></section>
        </main>
    </div>

    <script src="{{ asset('js/regulamento_usuario.js') }}"></script>
</body>
</html>

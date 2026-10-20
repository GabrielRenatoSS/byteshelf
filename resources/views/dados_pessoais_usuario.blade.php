<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Dados Pessoais</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dados_pessoais.css') }}">
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

    <div class="container personal-page-container">
        <aside class="sidebar">
            <h2 data-common-user-greeting>Olá!</h2>
            <nav>
                <ul id="menu-sidebar">
                    <li class="active"><i class="fa-regular fa-user"></i> Dados Pessoais</li>
                    <li onclick="meusPedidos()"><i class="fa-solid fa-box-open"></i> Meus pedidos</li>
                    <li><i class="fa-regular fa-bell"></i> Notificações</li>
                    <li><i class="fa-regular fa-calendar"></i> Prazos</li>
                    <li><i class="fa-regular fa-heart"></i> Propor doação</li>
                    <li><i class="fa-regular fa-comments"></i> Contate-nos</li>
                    <li onclick="regulamento()"><i class="fa-regular fa-file-lines"></i> Regulamento</li>
                </ul>
            </nav>
        </aside>

        <main class="content personal-content">
            <section class="personal-profile" aria-labelledby="personal-title">
                <div class="personal-heading">
                    <button type="button" class="personal-avatar" onclick="selecionarFoto()" aria-label="Alterar foto de perfil" title="Alterar foto de perfil">
                        <span class="personal-avatar-content" id="personal-avatar-content"><i class="fa-solid fa-user" aria-hidden="true"></i></span>
                        <span class="personal-avatar-edit"><i class="fa-solid fa-camera" aria-hidden="true"></i></span>
                    </button>
                    <input type="file" id="profile-photo-input" accept="image/*,.heic,.heif" hidden>
                    <h1 id="personal-title">Dados Pessoais</h1>
                </div>

                <div class="personal-fields" id="personal-fields"></div>

                <button type="button" class="edit-profile-button" id="edit-profile-button" onclick="editarDados()">
                    <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i><span>EDITAR</span>
                </button>
            </section>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/heic2any/0.0.4/heic2any.min.js"></script>
    <script src="{{ asset('js/dados_pessoais_usuario.js') }}"></script>
</body>
</html>

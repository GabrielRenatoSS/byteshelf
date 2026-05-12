<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Byteshelf - Gerenciamento</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="stylesheet" href="../css/global.css">
</head>
<body>


    <header class="top-nav">
        <div class="logo-container">
            <img src="../assets/logo_retangular_azul.jpeg" alt="Byteshelf" class="main-logo">
        </div>
        <div class="nav-icons">
            <i class="fa-solid fa-house"></i>
            <i class="fa-solid fa-right-from-bracket"></i>
            <i class="fa-solid fa-book-open"></i>
            <i class="fa-solid fa-user"></i>
            <i class="fa-solid fa-cart-shopping"></i>
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
                    <li class="active"><i class="fa-solid fa-users"></i> Usuários</li>
                    <li><i class="fa-regular fa-file-lines"></i> Regulamento</li>
                    <li><i class="fa-regular fa-envelope"></i> Enviar mensagem</li>
                    <li><i class="fa-regular fa-heart"></i> Doações</li>
                    <li><i class="fa-solid fa-chart-line"></i> Relatórios</li>
                </ul>
            </nav>
        </aside>


        <main class="content">
            <div class="content-header">
                <h1>Usuários</h1>
                <button class="add-btn" onclick="window.location.href='cadastro.html'">+</button>
            </div>


            <div class="user-list">


            </div>
        </main>
    </div> <div id="modal-confirmacao" class="modal">
        <div class="modal-content">
            <h3 id="modal-titulo">Título</h3>
            <p id="modal-texto">Texto</p>
            <div class="modal-buttons">
                <button onclick="fecharModal()" class="btn-cancelar">Cancelar</button>
                <button onclick="confirmarAcao()" class="btn-confirmar">Confirmar</button>
            </div>
        </div>
    </div>


    <script src="../js/perfil.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Catálogo</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="common-user-catalog">
    <header class="top-nav">
        <div class="logo-container">
            <img src="../assets/logo_retangular_azul.jpeg" alt="ByteShelf" class="main-logo">
        </div>
        <div class="nav-icons">
            <i class="fa-solid fa-house" onclick="irParaInicio()" title="Início"></i>
            <i class="fa-solid fa-right-from-bracket" onclick="sair()" title="Sair"></i>
            <i class="fa-solid fa-book-open" onclick="irParaCatalogo()" title="Catálogo"></i>
            <i class="fa-solid fa-user" onclick="irParaPerfil()" title="Perfil"></i>
            <i class="fa-solid fa-cart-shopping" onclick="irParaCarrinho()" title="Carrinho de empréstimos"></i>
        </div>
    </header>

    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-category-title">
                <h2>CATEGORIAS</h2>
            </div>
            <ul id="listaCategorias"></ul>
        </aside>

        <main class="content">
            <div class="content-header">
                <div>
                    <h1 class="tituloPrincipal">CATÁLOGO</h1>
                    <h2 class="subTitulo">DE COMPONENTES</h2>
                </div>
            </div>

            <div class="barra-pesquisa">
                <div class="pesquisa">
                    <input type="search" id="campoPesquisa" placeholder="Procure aqui seu componente..." aria-label="Pesquisar componente">
                    <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                </div>
            </div>

            <div class="catalogo-grid" id="catalogo"></div>
        </main>
    </div>

    <div class="modal" id="modalProduto" aria-hidden="true">
        <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="modalNome">
            <button class="fechar" type="button" data-close-product aria-label="Fechar detalhes do componente">
                <i class="fa-solid fa-circle-xmark" aria-hidden="true"></i>
            </button>
            <div class="modal-esquerda">
                <img id="modalImagem" src="" alt="Imagem do componente">
            </div>
            <div class="modal-direita">
                <h2 id="modalNome">Nome do componente</h2>
                <p id="modalEstoque" class="estoque"></p>
                <<form id="formAdicionarCarrinho" method="POST" action="">
                @csrf
                <button type="submit" class="btnCarrinho">
                    ADICIONAR AO CARRINHO
                    </button>
                </form>
                <div class="descricao-cadastro aberta">
                    <h3>DESCRIÇÃO</h3>
                    <p id="modalDescricao">Nenhuma descrição informada.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/catalogo_usuario.js') }}"></script>
</body>
</html>

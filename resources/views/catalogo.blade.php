<!DOCTYPE html>
<html lang="pt-BR">


<head>


    <meta charset="UTF-8">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>ByteShelf - Catálogo</title>


    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">


    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">


    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>




<body>




<!-- ================= HEADER ================= -->


<header class="top-nav">


    <div class="logo-container">


        <img
    src="{{ asset('assets/logo_retangular_azul.jpeg') }}"
    class="main-logo"
    alt="ByteShelf">


    </div>




        <div class="nav-icons">


            <!-- INÍCIO -->
            <i
                class="fa-solid fa-house"
                onclick="window.location.href='{{ route('inicio') }}'"
                title="Início">
            </i>




            <!-- SAIR -->
            @auth
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <i
        class="fa-solid fa-right-from-bracket"
        onclick="document.getElementById('logout-form').submit()"
        title="Sair">
    </i>
    @endauth




            <!-- CATÁLOGO -->
            <i
                class="fa-solid fa-book-open"
                onclick="window.location.href='{{ route('catalogo') }}'"
                title="Catálogo">
            </i>




            <!-- PERFIL -->
            <i
                class="fa-solid fa-user"
                onclick="window.location.href='{{ route('perfil') }}'"
                title="Perfil">
            </i>


            <!-- CARRINHO -->
            <i
                class="fa-solid fa-cart-shopping"
                onclick="carrinho()"
                title="Carrinho">
            </i>


        </div>


</header>






<!-- ================= CONTAINER ================= -->


<div class="container">




    <!-- ================= SIDEBAR ================= -->


    <aside class="sidebar">


        <h2>CATEGORIAS</h2>




        <ul id="listaCategorias">


            <li
                class="ativo"
                onclick="filtrarCategoria('Todos', this)">
                Todos
            </li>




            <li onclick="filtrarCategoria('Arduino', this)">
                Arduínos
            </li>




            <li onclick="filtrarCategoria('Capacitores', this)">
                Capacitores
            </li>




            <li onclick="filtrarCategoria('Circuitos', this)">
                Circuitos Integrados
            </li>




            <li onclick="filtrarCategoria('ESP32', this)">
                Esp32
            </li>




            <li onclick="filtrarCategoria('LED', this)">
                Leds
            </li>




            <li onclick="filtrarCategoria('Motores', this)">
                Motores
            </li>




            <li onclick="filtrarCategoria('Resistores', this)">
                Resistores
            </li>




            <li onclick="filtrarCategoria('Sensores', this)">
                Sensores
            </li>




            <li onclick="filtrarCategoria('Transistores', this)">
                Transistores
            </li>


            <li onclick="filtrarCategoria('Outros', this)">
                Outros
            </li>


        </ul>


    </aside>






    <!-- ================= CONTEÚDO ================= -->


    <main class="content">




        <div class="content-header">


            <div>


                <h1 class="tituloPrincipal">
                    CATÁLOGO
                </h1>


                <h2 class="subTitulo">
                    DE COMPONENTES
                </h2>


            </div>


        </div>






        <!-- ================= PESQUISA ================= -->


                <div class="barra-pesquisa">


            <div class="pesquisa">


                <input
                    type="text"
                    id="campoPesquisa"
                    placeholder="Procure aqui seu componente..."
                    onkeyup="pesquisarProduto()">


                <i class="fa-solid fa-magnifying-glass"></i>


            </div>


            <button
                class="filtro-btn"
                id="filtroDanificados"
                onclick="filtrarDanificados()"
                title="Mostrar componentes danificados">


                <i class="fa-solid fa-filter"></i>


            </button>


            <button
                class="add-btn"
                onclick="abrirCadastro()">


                +


            </button>


        </div>




        <!-- ================= PRODUTOS ================= -->


        <div
            class="catalogo-grid"
            id="catalogo">


        </div>




    </main>


</div>






<!-- ================================================= -->
<!-- MODAL DE VISUALIZAÇÃO DO PRODUTO -->
<!-- ================================================= -->


<div
    class="modal"
    id="modalProduto">




    <div class="modal-content">




        <!-- FECHAR -->


        <span
            class="fechar"
            onclick="fecharProduto()">


            <i class="fa-solid fa-circle-xmark"></i>


        </span>






        <!-- IMAGEM -->


        <div class="modal-esquerda">


            <img
                id="modalImagem"
                src=""
                alt="Imagem do componente">


        </div>






        <!-- INFORMAÇÕES -->


        <div class="modal-direita">




            <h2 id="modalNome">
                Nome do componente
            </h2>




            <p
                id="modalEstoque"
                class="estoque">
            </p>






            <button
                class="btnCarrinho"
                onclick="adicionarCarrinhoModal()">


                ADICIONAR AO CARRINHO


            </button>




            <div class="descricao-cadastro">


                <h3 onclick="alternarDescricao()">
                    DESCRIÇÃO
                    <i id="iconeDescricao" class="fa-solid fa-plus"></i>
                </h3>


                <p id="modalDescricao">
                    Nenhuma descrição informada.
                </p>


            </div>


            </div>




        </div>




    </div>


</div>






<!-- ================================================= -->
<!-- MODAL DE CADASTRO -->
<!-- ================================================= -->


<div
    class="modal"
    id="modalCadastro">




    <div class="modal-cadastro">




        <!-- TÍTULO -->


        <div class="titulo-modal">




            <h2 id="nomeComponente">
                Nome do Componente
            </h2>




            <i
                class="fa-solid fa-pen"
                onclick="editarNome()">
            </i>




        </div>






        <!-- CATEGORIA -->


        <div class="campo-categoria">




            <label for="categoria">
                Categoria:
            </label>




            <select id="categoria">




                <option value="">
                    Selecione
                </option>




                <option value="Arduino">
                    Arduino
                </option>




                <option value="Capacitores">
                    Capacitores
                </option>




                <option value="Circuitos">
                    Circuitos Integrados
                </option>




                <option value="ESP32">
                    ESP32
                </option>




                <option value="LED">
                    LED
                </option>




                <option value="Motores">
                    Motores
                </option>




                <option value="Resistores">
                    Resistores
                </option>




                <option value="Sensores">
                    Sensores
                </option>




                <option value="Transistores">
                    Transistores
                </option>




                <option value="Outros">
                    Outros
                </option>




            </select>




        </div>






        <!-- QUANTIDADE + DANIFICADO -->


        <div class="linha-informacoes">




            <!-- QUANTIDADE -->


            <div class="campo-quantidade">




                <span>
                    Quantidade em estoque:
                </span>




                <button
                    type="button"
                    onclick="diminuirQuantidade()">


                    −


                </button>




                <input
                    type="text"
                    id="quantidade"
                    value="0"
                    readonly>




                <button
                    type="button"
                    onclick="aumentarQuantidade()">


                    +


                </button>




            </div>






            <!-- DANIFICADO -->


            <div class="campo-danificado">




                <span>
                    O componente está danificado?
                </span>




                <input
                    type="checkbox"
                    id="danificado">




            </div>




        </div>






        <!-- IMAGEM + DESCRIÇÃO -->


        <div class="conteudo-modal">




            <!-- UPLOAD -->


            <div class="upload">


                <label for="imagem">


                    Faça upload de arquivos aqui


                    <i class="fa-solid fa-cloud-arrow-up"></i>


                </label>


                <input
                    type="file"
                    id="imagem"
                    multiple
                    accept="image/*">


                <small id="contadorImagem">
                    0/4
                </small>


            </div>






            <!-- DESCRIÇÃO -->


            <div class="descricao-cadastro">




                <textarea
                    id="descricao"
                    maxlength="1000"
                    placeholder="Insira aqui a descrição do novo componente...">
                </textarea>




                <small>


                    <span id="contadorTexto">
                        0
                    </span>/1000


                </small>




            </div>




        </div>






        <!-- CONCLUIR -->


        <button
            type="button"
            class="btnSalvar"
            onclick="salvarComponente()">


            Concluir


        </button>




    </div>


</div>




<!-- ================================================= -->
<!-- MODAL DE EDIÇÃO -->
<!-- ================================================= -->


<div class="modal" id="modalEdicao">


    <div class="modal-cadastro">


        <div class="titulo-modal">


            <h2 id="nomeEdicao">
                Nome do Componente
            </h2>


            <i
                class="fa-solid fa-pen"
                onclick="editarNomeEdicao()">
            </i>


        </div>




        <!-- CATEGORIA E QUANTIDADE -->


        <div class="linha-informacoes">


            <div class="campo-categoria">


                <label for="categoriaEdicao">
                    Categoria:
                </label>


                <select id="categoriaEdicao">


                    <option value="">Selecione</option>
                    <option value="Arduino">Arduino</option>
                    <option value="Capacitores">Capacitores</option>
                    <option value="Circuitos">Circuitos</option>
                    <option value="ESP32">ESP32</option>
                    <option value="LED">LED</option>
                    <option value="Motores">Motores</option>
                    <option value="Resistores">Resistores</option>
                    <option value="Sensores">Sensores</option>
                    <option value="Transistores">Transistores</option>
                    <option value="Outros">Outros</option>


                </select>


            </div>




            <div class="campo-quantidade">


                <span>
                    Quantidade em estoque:
                </span>


                <button onclick="diminuirQuantidadeEdicao()">
                    −
                </button>


                <input
                    type="text"
                    id="quantidadeEdicao"
                    value="0"
                    readonly>


                <button onclick="aumentarQuantidadeEdicao()">
                    +
                </button>


            </div>


        </div>




        <!-- DANIFICADO -->


        <div class="campo-danificado">


            <span>
                O componente está danificado?
            </span>


            <input
                type="checkbox"
                id="danificadoEdicao">


        </div>




        <!-- IMAGENS E DESCRIÇÃO -->


        <div class="conteudo-modal">


            <div class="upload">


                <label for="imagemEdicao">


                    Trocar imagens


                    <i class="fa-solid fa-cloud-arrow-up"></i>


                </label>


                <input
                    type="file"
                    id="imagemEdicao"
                    multiple
                    accept="image/*">


                <small id="contadorImagemEdicao">
                    0/4
                </small>


            </div>




            <div class="descricao-cadastro">


                <textarea
                    id="descricaoEdicao"
                    maxlength="1000"
                    placeholder="Insira aqui a descrição do componente...">
                </textarea>


                <small>


                    <span id="contadorTextoEdicao">
                        0
                    </span>/1000


                </small>


            </div>


        </div>




        <!-- BOTÃO -->


        <button
            class="btnSalvar"
            onclick="salvarEdicao()">


            Salvar alterações


        </button>


    </div>


</div>




<script src="{{ asset('js/catalogo.js') }}"></script>


</body>


</html>

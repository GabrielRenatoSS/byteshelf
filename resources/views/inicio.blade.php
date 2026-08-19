<!DOCTYPE html>
<html lang="pt-BR">


<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>ByteShelf - Início</title>


    <link rel="stylesheet" href="{{ asset('/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/inicio.css') }}">


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


            <img src="{{ asset('assets/logo_retangular_azul.jpeg') }}" class="main-logo" alt="ByteShelf">        


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




    <!-- ================= CONTEÚDO ================= -->


    <main class="inicio">


        <!-- MENSAGEM -->


        <section class="boas-vindas">


            <h1>
                Bem-vindo<br>
                novamente!
            </h1>


        </section>




        <!-- OPÇÕES -->


        <section class="opcoes-inicio">




            <div
                class="opcao"
                onclick="irParaPedidos()">


                <i class="fa-solid fa-arrow-right"></i>


                <span>
                    Acesse os pedidos dos usuários
                </span>


            </div>




            <div
                class="opcao"
                onclick="irParaReservas()">


                <i class="fa-solid fa-arrow-right"></i>


                <span>
                    Consulte suas reservas
                </span>


            </div>




            <div
                class="opcao"
                onclick="irParaCadastroComponentes()">


                <i class="fa-solid fa-arrow-right"></i>


                <span>
                    Cadastre novos componentes
                </span>


            </div>




            <div
                class="opcao"
                onclick="irParaCadastroUsuarios()">


                <i class="fa-solid fa-arrow-right"></i>


                <span>
                    Cadastre novos usuários
                </span>


            </div>




        </section>


    </main>




    <script src="{{ asset('/js/inicio.js') }}"></script>


</body>


</html>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro ByteShelf</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header>
        <img class="logo-top" src="{{ asset('assets/logo_retangular_azul.jpeg') }}">
    </header>
    
    <div class="main">
        <div class="logo-area">
            <img src="{{ asset('assets/logo_quadrado_azul.jpeg') }}">
        </div>

        <div class="login-box">
            <h2>Cadastre-se</h2>

            <p style="text-align: center; margin-bottom: 25px; color: #555; font-size: 0.95rem; line-height: 1.4;">
                O cadastro é realizado de forma automática utilizando seu e-mail institucional do Google.
            </p>

            <form action="{{ route('google.redirect') }}" method="GET">
                <button type="submit">
                    <i class="fa-brands fa-google" style="margin-right: 8px;"></i>
                    Cadastrar-se com o Google
                </button>
            </form>

            @if ($errors->has('google'))
                <span class="error-msg" style="display: block; text-align: center; margin-top: 15px;">
                    {{ $errors->first('google') }}
                </span>
            @endif

            <div class="senha-line" style="display: flex; justify-content: flex-end; margin-top: 20px;">
                <a href="{{ route('paglogin') }}">Já possui cadastro? Faça login</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
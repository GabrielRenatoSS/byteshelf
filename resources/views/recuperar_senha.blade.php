<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Recuperar senha</title>

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <img src="{{ asset('assets/logo_retangular_azul.jpeg') }}" class="logo-top">
</header>

<div class="main">

    <div class="logo-area">
        <img src="{{ asset('assets/logo_quadrado_azul.jpeg') }}" class="logo-big">
    </div>

    <div class="login-box">
        <h2>Recupere sua senha</h2>

        @if ($errors->any())
            <p class="erro">{{ $errors->first() }}</p>
        @endif

        @if (session('status'))
            <p style="color: green;">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('password.send') }}">
            @csrf

            <label>E-mail institucional</label>

            <div class="input">
                <i class="fa-regular fa-envelope"></i>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="seuemail@aluno.iffar.edu.br"
                    required
                >
            </div>

            <button type="submit">Confirmar</button>
        </form>

        <p style="margin-top: 15px;">
            <a href="{{ route('paglogin') }}">Voltar para o login</a>
        </p>
    </div>

</div>

<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova senha</title>

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
        <h2>Crie uma nova senha</h2>

        @if ($errors->any())
            <p class="erro">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('nova.senha.update') }}">
            @csrf

            <label>Nova senha</label>
            <div class="input">
                <i class="fa-solid fa-lock"></i>
                <input 
                    type="password"
                    name="password"
                    id="novaSenha"
                    placeholder="••••••••"
                    required
                >
                <i class="fa-solid fa-eye-slash eye" onclick="toggleSenha('novaSenha', this)"></i>
            </div>

            <label>Confirmar nova senha</label>
            <div class="input">
                <i class="fa-solid fa-lock"></i>
                <input 
                    type="password"
                    name="password_confirmation"
                    id="confirmarSenha"
                    placeholder="••••••••"
                    required
                >
                <i class="fa-solid fa-eye-slash eye" onclick="toggleSenha('confirmarSenha', this)"></i>
            </div>

            <button type="submit">Confirmar</button>
        </form>
    </div>

</div>

<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
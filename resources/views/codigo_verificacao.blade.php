<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Código de verificação</title>

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

        <form method="POST" action="{{ route('codigo.verify') }}" id="formCodigo">
            @csrf

            <label>Código de Verificação</label>

            <div class="codigo">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
            </div>

            <input type="hidden" name="codigo" id="codigoCompleto">

            <button type="submit">Confirmar</button>
        </form>
    </div>

</div>

<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
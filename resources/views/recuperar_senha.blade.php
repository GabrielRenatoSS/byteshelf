<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Recuperar senha</title>
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="stylesheet" href="../../public/css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <img src="{{ asset('logo_retangular_azul.png') }}" class="logo-top">
</header>

<div class="main">

    <div class="logo-area">
        <img src="{{ asset('logo_quadrado_azul.png') }}" class="logo-big">
    </div>

    <div class="login-box">

        <h2>Recupere sua senha</h2>

        @if ($errors->any())
            <p class="error">{{ $errors->first('email') }}</p>
        @endif

        <form method="POST" action="{{ route('password.send') }}">
            @csrf

            <label>E-mail institucional</label>
            <div class="input">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="seuemail@aluno.iffar.edu.br" required>
            </div>

            <button type="submit">Confirmar</button>
        </form>

        <p style="margin-top:15px;">
            <a href="/">Voltar para o login</a>
        </p>

    </div>

</div>

<script src="{{ asset('script.js') }}"></script>

</body>
</html>

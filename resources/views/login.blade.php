<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login ByteShelf</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <header>
        <img src="logo_retangular_azul.png" class="logo-top">
    </header>
    
    <div class="main">
        <div class="logo-area">
            <img src="logo_quadrado_azul.png" class="logo-big">
        </div>
    <div class="login-box">

    <h2>Faça login na sua conta</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>E-mail institucional</label>

        <div class="input">
            <i class="fa-regular fa-envelope"></i>
            <input type="email" name="email" placeholder="seuemail@aluno.iffar.edu.br"
                value="{{ old('email') }}" required>
        </div>

        @error('email')
            <span class="error-msg">{{ $message }}</span>
        @enderror

        <div class="senha-line">
            <label>Senha</label>
            <a href="recuperar_senha.html">Esqueceu sua senha?</a>
        </div>

        <div class="input">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" id="senha" placeholder="••••••••" required>
            <i class="fa-solid fa-eye-slash eye" onclick="toggleSenha('senha', this)"></i>
        </div>

        <button type="submit">Entrar</button>
    </form>

</div>
</div>

<script src="script.js"></script>

</body>
</html>

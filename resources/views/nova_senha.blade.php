<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova senha</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<header>
    <img src="{{ asset('logo_retangular_azul.png') }}" class="logo-top" alt="ByteShelf">
</header>

<div class="main">
    <div class="logo-area">
        <img src="{{ asset('logo_quadrado_azul.png') }}" class="logo-big" alt="ByteShelf">
    </div>

    <div class="login-box">
        <h2>Crie uma nova senha</h2>

        @if ($errors->any())
            @foreach ($errors->all() as $erro)
                <p style="color:#c0392b; font-size:14px;">{{ $erro }}</p>
            @endforeach
        @endif

        <form method="POST" action="{{ route('nova.senha.update') }}">
            @csrf

            <label>Nova senha</label>
            <div class="input">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="novaSenha" name="password" placeholder="••••••••" required>
                <i class="fa-solid fa-eye-slash eye" onclick="toggleSenha('novaSenha', this)"></i>
            </div>

            <label>Confirmar nova senha</label>
            <div class="input">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="confirmarSenha" name="password_confirmation" placeholder="••••••••" required>
                <i class="fa-solid fa-eye-slash eye" onclick="toggleSenha('confirmarSenha', this)"></i>
            </div>

            <button type="submit">Confirmar</button>
        </form>
    </div>
</div>

<script>
    function toggleSenha(id, elemento) {
        const campo = document.getElementById(id);

        if (campo.type === 'password') {
            campo.type = 'text';
            elemento.classList.remove('fa-eye-slash');
            elemento.classList.add('fa-eye');
        } else {
            campo.type = 'password';
            elemento.classList.remove('fa-eye');
            elemento.classList.add('fa-eye-slash');
        }
    }
</script>

</body>
</html>
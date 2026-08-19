<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Código de verificação</title>
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="stylesheet" href="../../public/css/global.css">
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
        <h2>Recupere sua senha</h2>
        <p style="font-size:14px; margin-bottom:15px;">
            Código enviado para: <strong>{{ $email }}</strong>
        </p>

        @if ($errors->any())
            @foreach ($errors->all() as $erro)
                <p style="color:#c0392b; font-size:14px;">{{ $erro }}</p>
            @endforeach
        @endif

        @if (session('status'))
            <p style="color:#1e8449; font-size:14px;">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('codigo.verify') }}" id="formCodigo">
            @csrf

            <label>Código de verificação</label>
            <div class="codigo">
                <input type="text" maxlength="1" inputmode="numeric" class="code" required autofocus>
                <input type="text" maxlength="1" inputmode="numeric" class="code" required>
                <input type="text" maxlength="1" inputmode="numeric" class="code" required>
                <input type="text" maxlength="1" inputmode="numeric" class="code" required>
                <input type="text" maxlength="1" inputmode="numeric" class="code" required>
                <input type="text" maxlength="1" inputmode="numeric" class="code" required>
            </div>

            <input type="hidden" name="codigo" id="codigoCompleto">

            <p id="timer" style="font-size:14px; margin:10px 0;">
                Código expira em: 03:00
            </p>

            <button type="submit">Confirmar</button>
        </form>

        <form method="POST" action="{{ route('password.send') }}" style="margin-top:15px;">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <button type="submit">Reenviar código</button>
        </form>

        <p style="margin-top:15px;">
            <a href="{{ route('password.request') }}">Voltar</a>
        </p>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('.code');
    const codigoCompleto = document.getElementById('codigoCompleto');
    const formCodigo = document.getElementById('formCodigo');

    function atualizarCodigoCompleto() {
        codigoCompleto.value = Array.from(inputs).map(input => input.value).join('');
    }

    inputs.forEach((input, index) => {
        input.addEventListener('input', () => {
            input.value = input.value.replace(/\D/g, '');
            atualizarCodigoCompleto();

            if (input.value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', (event) => {
            if (event.key === 'Backspace' && !input.value && index > 0) {
                inputs[index - 1].focus();
            }
        });

        input.addEventListener('paste', (event) => {
            event.preventDefault();
            const texto = event.clipboardData.getData('text').replace(/\D/g, '').slice(0, 6);

            inputs.forEach((campo, i) => {
                campo.value = texto[i] || '';
            });

            atualizarCodigoCompleto();

            if (texto.length === 6) {
                inputs[5].focus();
            }
        });
    });

    formCodigo.addEventListener('submit', (event) => {
        atualizarCodigoCompleto();

        if (codigoCompleto.value.length !== 6) {
            event.preventDefault();
            alert('Digite o código completo com 6 dígitos.');
        }
    });

    let tempo = 180;
    const timer = document.getElementById('timer');

    const intervalo = setInterval(() => {
        tempo--;

        if (tempo <= 0) {
            clearInterval(intervalo);
            timer.textContent = 'Código expirado. Reenvie o código.';
            return;
        }

        const minutos = String(Math.floor(tempo / 60)).padStart(2, '0');
        const segundos = String(tempo % 60).padStart(2, '0');
        timer.textContent = `Código expira em: ${minutos}:${segundos}`;
    }, 1000);
</script>
</body>
</html>

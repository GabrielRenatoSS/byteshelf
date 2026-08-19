<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login ByteShelf</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
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

            <h2>Faça login na sua conta</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label>E-mail institucional</label>

                <div class="input @error('email') input-error @enderror">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" placeholder="seuemail@aluno.iffar.edu.br"
                        value="{{ old('email') }}" required>
                </div>

                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror

                <div class="senha-line">
                    <label>Senha</label>
                    <a href="{{ route('recuperao') }}">Esqueceu sua senha?</a>
                </div>

                <div class="input @error('email') input-error @enderror">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="senha" placeholder="••••••••" required>
                    <i class="fa-solid fa-eye-slash eye" onclick="toggleSenha('senha', this)"></i>
                </div>

                <button type="submit">Entrar</button>

                <div class="senha-line" style="display: flex; justify-content: flex-end;">
                    <a href="{{ route('cadastro') }}">Não possui cadastro? Cadastre-se</a>
                </div>
            </form>

            <div style="display: flex; align-items: center; text-align: center; margin: 20px 0; color: #888;">
                <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
                <span style="padding: 0 10px; font-size: 0.85rem;">OU</span>
                <div style="flex: 1; border-bottom: 1px solid #ccc;"></div>
            </div>

            <form action="{{ route('google.redirect') }}" method="GET">
                <button type="submit" class="btn-google" style="background-color: #ffffff; color: #ffffff; border: 1px solid #ccc; width: 100%; display: flex; align-items: center; justify-content: center; gap: 10px; cursor: pointer;">
                    <i class="fa-brands fa-google" style="color: #ffffff;"></i>
                    Entrar com o Google
                </button>
            </form>

            @if ($errors->has('google'))
                <span class="error-msg" style="display: block; text-align: center; margin-top: 10px;">
                    {{ $errors->first('google') }}
                </span>
            @endif

        </div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
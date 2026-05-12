<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Código de verificação</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/global.css">
</head>

<body>
    <header>
        <img src="../assets/logo_retangular_azul.jpeg" class="logo-top">
    </header>
    
    <div class="main">
        <div class="logo-area">
            <img src="../assets/logo_quadrado_azul.jpeg" class="logo-big">
        </div>
        
        <div class="login-box">
            <h2>Recupere sua senha</h2>
            <label>Código de Verificação</label>
            
            <div class="codigo">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
                <input type="text" maxlength="1" class="code">
            </div>


            <button onclick="verificarCodigo()">Confirmar</button>
        </div>

    </div>

    <script src="../css/login.js"></script>

</body>
</html>

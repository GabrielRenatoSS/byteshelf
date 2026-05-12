<!DOCTYPE html>
<html lang="pt-br">
<head>


<meta charset="UTF-8">
<title>Cadastro ByteShelf</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/global.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


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
    <h2>Cadastre um novo usuário</h2>
   
    <form id="form-cadastro">
        <label>E-mail institucional</label>
        <div class="input">
            <i class="fa-regular fa-envelope"></i>
            <input
            type="email"
            id="cad-email"
            placeholder="seuemail@aluno.iffar.edu.br" required>
        </div>


        <label>Senha</label>
        <div class="input">
            <i class="fa-solid fa-lock"></i>
            <input
            type="password" id="cad-senha"
            placeholder="••••••••" required>
            <i class="fa-solid fa-eye-slash eye" onclick="toggleSenha('cad-senha', this)"></i>
        </div>


        <label>Nome Completo</label>
        <div class="input">
            <input
            type="text"
            id="cad-nome"
            placeholder="Nome do usuário" required>
        </div>


        <label>CPF</label>
        <div class="input">
            <input
            type="text"
            id="cad-cpf"
            placeholder="000.000.000-00" required>
        </div>


        <label>Matrícula</label>
        <div class="input">
            <input
            type="text"
            id="cad-matricula" required>
        </div>


        <button type="submit">Cadastrar</button>
    </form>
</div>


</div>


<script src="../js/login.js"></script>


</body>
</html>

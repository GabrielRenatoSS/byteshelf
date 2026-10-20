console.log("Arquivo perfil.js carregado com sucesso!");

let elementoClicado = null;
let tipoAcaoAtual = "";

// Abrir modal
window.abrirModal = function (tipo, nome, elemento) {
    elementoClicado = elemento;
    tipoAcaoAtual = tipo;

    const modal = document.getElementById("modal-confirmacao");
    const titulo = document.getElementById("modal-titulo");
    const texto = document.getElementById("modal-texto");

    if (!modal) return;

    modal.style.display = "flex";

    if (tipo === "bloquear") {
        if (elemento.classList.contains("bloqueado")) {
            tipoAcaoAtual = "desbloquear";
            titulo.innerText = "Desbloquear Usuário";
            texto.innerText = `Deseja restaurar o acesso de ${nome}?`;
        } else {
            titulo.innerText = "Bloquear Usuário";
            texto.innerText = `Deseja suspender o acesso de ${nome}?`;
        }
    } else if (tipo === "excluir") {
        titulo.innerText = "Excluir Usuário";
        texto.innerText = `Tem certeza que deseja remover ${nome}?`;
    }
};

// Fechar modal
window.fecharModal = function () {
    const modal = document.getElementById("modal-confirmacao");

    if (modal) {
        modal.style.display = "none";
    }
};

// Confirmar ação do modal (Adapta para enviar requisições AJAX/Form para o Laravel se necessário)
window.confirmarAcao = function () {
    if (tipoAcaoAtual === "bloquear") {
        elementoClicado.classList.add("bloqueado");
        elementoClicado.innerHTML = '<i class="fa-solid fa-unlock"></i>';
        alert("Usuário bloqueado!");
    } else if (tipoAcaoAtual === "desbloquear") {
        elementoClicado.classList.remove("bloqueado");
        elementoClicado.innerHTML = '<i class="fa-solid fa-ban"></i>';
        alert("Usuário desbloqueado!");
    } else if (tipoAcaoAtual === "excluir") {
        const textoModal = document.getElementById("modal-texto").innerText;
        const nomeParaRemover = textoModal
            .replace("Tem certeza que deseja remover ", "")
            .replace("?", "")
            .trim();

        elementoClicado.closest(".user-row").remove();
        alert(nomeParaRemover + " foi removido permanentemente!");
    }

    fecharModal();
};

// Fechar modal clicando fora
window.onclick = function (event) {
    const modal = document.getElementById("modal-confirmacao");

    if (event.target === modal) {
        fecharModal();
    }
};

// Ir para a tela de enviar mensagem
window.prepararMensagem = function (email) {
    if (!email) {
        window.location.href = "/enviar-mensagem";
        return;
    }

    window.location.href = "/enviar-mensagem?email=" + encodeURIComponent(email);
};

// Funções de navegação atualizadas para as rotas do Laravel
window.sair = function () {
    window.location.href = "/login";
};

window.catalogo = function () {
    window.location.href = "/catalogo";
};

window.home = function () {
    window.location.href = "/home";
};

window.perfil = function () {
    window.location.href = "/perfil";
};

window.carrinho = function () {
    window.location.href = "/carrinho";
};

// Configuração inicial apenas para eventos de fechar modais, sem manipulação de localStorage
document.addEventListener("DOMContentLoaded", function () {
    console.log("Interface de utilizadores pronta para receber dados do Laravel.");
});
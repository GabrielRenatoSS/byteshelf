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

// Confirmar ação do modal
window.confirmarAcao = function () {
    let usuariosSalvos = JSON.parse(localStorage.getItem("usuariosSalvos")) || [];

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

        usuariosSalvos = usuariosSalvos.filter(user => user.nome !== nomeParaRemover);
        localStorage.setItem("usuariosSalvos", JSON.stringify(usuariosSalvos));

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

// Funções de navegação
window.sair = function () {
    window.location.href = "/login";
};

window.catalogo = function () {
    window.location.href = "/componente";
};

window.home = function () {
    window.location.href = "/home";
};

window.perfil = function () {
    window.location.href = "/users";
};

window.carrinho = function () {
    window.location.href = "/carrinho";
};

// Ao carregar a página
document.addEventListener("DOMContentLoaded", function () {
    const listaHtml = document.querySelector(".user-list");

    if (!listaHtml) return;

    // Se a lista já veio do Laravel, não apaga ela
    if (listaHtml.querySelector(".user-row")) {
        return;
    }

    // Usuário padrão só para teste
    if (!localStorage.getItem("usuariosSalvos")) {
        const inicial = [
            {
                nome: "Arthur Brizola",
                matricula: "202210045",
                email: "arthur@aluno.iffar.edu.br"
            }
        ];

        localStorage.setItem("usuariosSalvos", JSON.stringify(inicial));
    }

    const usuariosSalvos = JSON.parse(localStorage.getItem("usuariosSalvos")) || [];

    listaHtml.innerHTML = "";

    usuariosSalvos.forEach(user => {
        const nome = user.nome || "Sem nome";
        const matricula = user.matricula || "Sem matrícula";
        const email = user.email || "";

        const novaLinha = `
            <div class="user-row">
                <div class="user-info">
                    <div class="avatar">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <div>
                        <p class="user-name">${nome}</p>
                        <p class="id-number">ID: ${matricula}</p>
                    </div>
                </div>

                <div class="actions">
                    <button class="btn-action" type="button" onclick="abrirModal('bloquear', '${nome}', this)">
                        <i class="fa-solid fa-ban"></i>
                    </button>

                    <button class="btn-action" type="button" onclick="prepararMensagem('${email}')">
                        <i class="fa-regular fa-envelope"></i>
                    </button>

                    <button class="btn-action" type="button" onclick="abrirModal('excluir', '${nome}', this)">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        `;

        listaHtml.innerHTML += novaLinha;
    });
});
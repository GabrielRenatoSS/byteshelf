function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
}

function closeModal(modal) {
    const target = typeof modal === "string" ? document.getElementById(modal) : modal;
    if (!target) return;
    target.classList.remove("is-open");
    target.setAttribute("aria-hidden", "true");
}

function configureDetailEvents() {
    document.querySelectorAll("[data-close-modal]").forEach(button => {
        button.addEventListener("click", () => closeModal(button.closest(".order-modal")));
    });

    document.querySelectorAll(".order-modal").forEach(modal => {
        modal.addEventListener("click", event => {
            if (event.target === modal) closeModal(modal);
        });
    });

    document.addEventListener("keydown", event => {
        if (event.key !== "Escape") return;
        document.querySelectorAll(".order-modal.is-open").forEach(closeModal);
    });
}

// Funções de navegação atualizadas para as views do Laravel (.blade.php)
function home() {
    window.location.href = "/inicio";
}

function sair() {
    window.location.href = "/login";
}

function catalogo() {
    window.location.href = "/catalogo";
}

function perfil() {
    window.location.href = "/dados_pessoais";
}

function carrinho() {
    window.location.href = "/reservas";
}

function dadosPessoais() {
    window.location.href = "/dados_pessoais";
}

function usuarios() {
    window.location.href = "/usuarios";
}

function regulamento() {
    window.location.href = "/regulamento";
}

function reservas() {
    window.location.href = "/reservas";
}

function abrirEnviarMensagem() {
    localStorage.removeItem("emailDestinatario");
    window.location.href = "/enviar-mensagem";
}

function voltarPedidos() {
    window.location.href = "/pedidos";
}

document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById("order-detail")) {
        configureDetailEvents();
    }
});
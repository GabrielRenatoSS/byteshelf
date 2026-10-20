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

function configureReservationModals() {
    const modal = document.getElementById("reservation-return-modal");
    if (!modal) return;

    const closeBtn = modal.querySelector("[data-close-reservation-modal]");
    if (closeBtn) {
        closeBtn.addEventListener("click", () => closeModal(modal));
    }

    modal.addEventListener("click", event => {
        if (event.target === modal) closeModal(modal);
    });

    document.addEventListener("keydown", event => {
        if (event.key === "Escape") closeModal(modal);
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

function pedidos() {
    window.location.href = "/pedidos";
}

function usuarios() {
    window.location.href = "/usuarios";
}

function regulamento() {
    window.location.href = "/regulamento";
}

function abrirEnviarMensagem() {
    localStorage.removeItem("emailDestinatario");
    window.location.href = "/enviar-mensagem";
}

document.addEventListener("DOMContentLoaded", () => {
    configureReservationModals();
});
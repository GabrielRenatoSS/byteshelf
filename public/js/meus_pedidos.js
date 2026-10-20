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

function configureCommonModals() {
    document.querySelectorAll("[data-close-common-modal]").forEach(button => {
        button.addEventListener("click", () => closeModal(button.closest(".common-order-modal")));
    });

    document.querySelectorAll(".common-order-modal").forEach(modal => {
        modal.addEventListener("click", event => {
            if (event.target === modal) closeModal(modal);
        });
    });

    document.addEventListener("keydown", event => {
        if (event.key !== "Escape") return;
        document.querySelectorAll(".common-order-modal.is-open").forEach(closeModal);
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
    window.location.href = "/dados_pessoais_usuario";
}

function carrinho() {
    window.location.href = "/carrinho";
}

function dadosPessoais() {
    window.location.href = "/dados_pessoais_usuario";
}

function regulamento() {
    window.location.href = "/regulamento_usuario";
}

function voltarPedidos() {
    window.location.href = "/meus_pedidos";
}

document.addEventListener("DOMContentLoaded", () => {
    configureCommonModals();
});
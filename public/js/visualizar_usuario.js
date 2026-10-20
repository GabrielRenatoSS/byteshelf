function showTab(tab) {
    const details = document.getElementById("user-details-card");
    const history = document.getElementById("user-history-card");
    const showHistory = tab === "history";

    if (details) details.hidden = showHistory;
    if (history) history.hidden = !showHistory;

    document.querySelectorAll(".view-tab").forEach(button => {
        button.classList.toggle("is-active", button.dataset.tab === tab);
    });
}

function configureEvents() {
    document.addEventListener("click", event => {
        const tab = event.target.closest(".view-tab");
        if (tab) showTab(tab.dataset.tab);
    });
}

// Funções de navegação atualizadas para views do Laravel (.blade.php)
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

function voltarUsuarios() {
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get("pedido");

    if (orderId) {
        window.location.href = `/pedido_detalhes?id=${encodeURIComponent(orderId)}`;
        return;
    }

    window.location.href = "/usuarios";
}

configureEvents();
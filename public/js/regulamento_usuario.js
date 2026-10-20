function renderAdministratorGreeting() {
    const greeting = document.querySelector("[data-administrator-greeting]");
    if (!greeting) return;

    try {
        const administrator = JSON.parse(localStorage.getItem("administradorDados")) || {};
        const firstName = String(administrator.nome || "").trim().split(/\s+/)[0];
        greeting.textContent = firstName ? `Olá, ${firstName}!` : "Olá!";
    } catch {
        greeting.textContent = "Olá!";
    }
}

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

function pedidos() {
    window.location.href = "/pedidos";
}

function reservas() {
    window.location.href = "/reservas";
}

function abrirEnviarMensagem() {
    localStorage.removeItem("emailDestinatario");
    window.location.href = "/enviar-mensagem";
}

renderAdministratorGreeting();
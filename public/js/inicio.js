function inicio() {
    window.location.href = "/inicio";
}

function catalogo() {
    window.location.href = "/catalogo";
}

function perfil() {
    window.location.href = "/usuarios";
}

function carrinho() {
    window.location.href = "/carrinho";
}

function sair() {
    const confirmar = confirm("Deseja realmente sair?");

    if (confirmar) {
        window.location.href = "/login";
    }
}

/* ================================================= */
/* OPÇÕES DA TELA INICIAL */
/* ================================================= */

function irParaPedidos() {
    window.location.href = "/pedidos";
}

function irParaReservas() {
    window.location.href = "/reservas";
}

function irParaCadastroComponentes() {
    window.location.href = "/catalogo";
}

function irParaCadastroUsuarios() {
    window.location.href = "/cadastro";
}
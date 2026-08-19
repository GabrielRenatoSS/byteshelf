/* ================================================= */
/* NAVEGAÇÃO DO HEADER */
/* ================================================= */


function inicio() {
    window.location.href = "inicio.html";
}




function catalogo() {
    window.location.href = "../catalogo/catalogo.html";
}




function perfil() {
    window.location.href = "../perfil/usuarios.html";
}




function carrinho() {
    window.location.href = "../carrinho/carrinho.html";
}




/* ================================================= */
/* SAIR */
/* ================================================= */


function sair() {


    const confirmar = confirm("Deseja realmente sair?");


    if (confirmar) {
        window.location.href = "../login/login.html";
    }


}




/* ================================================= */
/* OPÇÕES DA TELA INICIAL */
/* ================================================= */


function irParaPedidos() {
    window.location.href = "../perfil/pedidos.html";
}




function irParaReservas() {
    window.location.href = "../perfil/reservas.html";
}




function irParaCadastroComponentes() {
    window.location.href = "../catalogo/catalogo.html";
}




function irParaCadastroUsuarios() {
    window.location.href = "../perfil/cadastro.html";
}

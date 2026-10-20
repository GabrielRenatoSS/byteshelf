function selecionarFoto() {
    const photoInput = document.getElementById("profile-photo-input");
    if (photoInput) photoInput.click();
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

function meusPedidos() {
    window.location.href = "/meus_pedidos";
}

function regulamento() {
    window.location.href = "/regulamento_usuario";
}

// Se precisares de submeter a foto automaticamente ao selecionar no input (via AJAX ou form submit):
document.addEventListener("DOMContentLoaded", () => {
    const photoInput = document.getElementById("profile-photo-input");
    if (photoInput) {
        photoInput.addEventListener("change", event => {
            const [photo] = event.target.files;
            if (photo) {
                // Podes submeter o formulário pai automaticamente se estiveres a usar um <form> tradicional
                photoInput.closest("form")?.submit();
            }
        });
    }
});
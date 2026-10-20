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
    window.location.href = "/dados_pessoais";
}

function carrinho() {
    window.location.href = "/reservas";
}

function usuarios() {
    window.location.href = "/usuarios";
}

function regulamento() {
    window.location.href = "/regulamento";
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

// Submissão automática do formulário de foto caso o input mude
document.addEventListener("DOMContentLoaded", () => {
    const photoInput = document.getElementById("profile-photo-input");
    if (photoInput) {
        photoInput.addEventListener("change", event => {
            const [photo] = event.target.files;
            if (photo) {
                photoInput.closest("form")?.submit();
            }
        });
    }
});
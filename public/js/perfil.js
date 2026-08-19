console.log("Arquivo perfil.js carregado com sucesso!");

let elementoClicado = null;
let tipoAcaoAtual = "";

// Forçar a função para o escopo global
window.abrirModal = function(tipo, nome, elemento) {
    elementoClicado = elemento;
    tipoAcaoAtual = tipo;

    const modal = document.getElementById('modal-confirmacao');
    const titulo = document.getElementById('modal-titulo');
    const texto = document.getElementById('modal-texto');

    if (!modal) return;

    modal.style.display = 'flex';

    if (tipo === 'bloquear') {
        if (elemento.classList.contains('bloqueado')) {
            tipoAcaoAtual = "desbloquear";
            titulo.innerText = "Desbloquear Usuário";
            texto.innerText = `Deseja restaurar o acesso de ${nome}?`;
        } else {
            titulo.innerText = "Bloquear Usuário";
            texto.innerText = `Deseja suspender o acesso de ${nome}?`;
        }
    } else if (tipo === 'excluir') {
        titulo.innerText = "Excluir Usuário";
        texto.innerText = `Tem certeza que deseja remover ${nome}?`;
    }
};

window.fecharModal = function() {
    const modal = document.getElementById('modal-confirmacao');
    if (modal) modal.style.display = 'none';
};

window.confirmarAcao = function() {
    if (tipoAcaoAtual === 'bloquear') {
        elementoClicado.classList.add('bloqueado');
        elementoClicado.innerHTML = '<i class="fa-solid fa-unlock"></i>';
        alert("Usuário bloqueado!");
    }
    else if (tipoAcaoAtual === 'desbloquear') {
        elementoClicado.classList.remove('bloqueado');
        elementoClicado.innerHTML = '<i class="fa-solid fa-ban"></i>';
        alert("Usuário desbloqueado!");
    }
    else if (tipoAcaoAtual === 'excluir') {
        const textoModal = document.getElementById('modal-texto').innerText;
        const nomeParaRemover = textoModal.replace("Tem certeza que deseja remover ", "").replace("?", "").trim();

        // Remover a linha correspondente visualmente
        if (elementoClicado) {
            elementoClicado.closest('.user-card, .user-row').remove();
        }

        alert(nomeParaRemover + " foi removido!");
    }
    fecharModal();
};

// Fechar ao clicar fora
window.onclick = function(event) {
    const modal = document.getElementById('modal-confirmacao');
    if (event.target == modal) fecharModal();
};

window.prepararMensagem = function(email) {
    localStorage.setItem('emailDestinatario', email);
    window.location.href = 'enviar_mensagem.blade.php';
};

window.carrinho = function() {
    window.location.href = "/carrinho";
};
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
    let usuariosSalvos = JSON.parse(localStorage.getItem('usuariosSalvos')) || [];


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
        // Pega o nome do usuário a partir do título/texto do modal
        const textoModal = document.getElementById('modal-texto').innerText;
        // Tenta extrair o nome (considerando o formato "remover Nome?")
        const nomeParaRemover = textoModal.replace("Tem certeza que deseja remover ", "").replace("?", "").trim();


        // 1. Remover visualmente
        elementoClicado.closest('.user-row').remove();


        // 2. Remover da memória (LocalStorage)
        usuariosSalvos = usuariosSalvos.filter(user => user.nome !== nomeParaRemover);
        localStorage.setItem('usuariosSalvos', JSON.stringify(usuariosSalvos));


        alert(nomeParaRemover + " foi removido permanentemente!");
    }
    fecharModal();
};


// Fechar ao clicar fora
window.onclick = function(event) {
    const modal = document.getElementById('modal-confirmacao');
    if (event.target == modal) fecharModal();
};


// AO CARREGAR A PÁGINA
document.addEventListener('DOMContentLoaded', function() {
    const listaHtml = document.querySelector('.user-list');
   
    // Se a memória estiver vazia, coloca o Arthur Brizola lá como padrão
    if (!localStorage.getItem('usuariosSalvos')) {
        const inicial = [{ nome: "Arthur Brizola", matricula: "202210045" }];
        localStorage.setItem('usuariosSalvos', JSON.stringify(inicial));
    }


    const usuariosSalvos = JSON.parse(localStorage.getItem('usuariosSalvos')) || [];


    // Limpa a lista do HTML antes de preencher (para não duplicar o Arthur fixo)
    listaHtml.innerHTML = "";


    usuariosSalvos.forEach(user => {
        const novaLinha = `
            <div class="user-row">
                <div class="user-info">
                    <div class="avatar"><i class="fa-solid fa-user"></i></div>
                    <div>
                        <p class="user-name">${user.nome}</p>
                        <p class="id-number">ID: ${user.matricula}</p>
                    </div>
                </div>
                <div class="actions">
                    <button class="btn-action" onclick="abrirModal('bloquear', '${user.nome}', this)">
                        <i class="fa-solid fa-ban"></i>
                    </button>
                    <button class="btn-action" onclick="window.location.href='enviar_mensagem.html'">
                        <i class="fa-regular fa-envelope"></i>
                    </button>
                    <button class="btn-action" onclick="abrirModal('excluir', '${user.nome}', this)">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>`;
        listaHtml.innerHTML += novaLinha;
    });
});

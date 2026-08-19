// Este código roda assim que a página termina de carregar
document.addEventListener('DOMContentLoaded', function() {
    console.log("Página de mensagem carregada!");


    // Busca o e-mail que o perfil.js salvou no LocalStorage
    const emailDestinatario = localStorage.getItem('emailDestinatario');
   
    const campoEmail = document.getElementById('email-destino');


    if (emailDestinatario && campoEmail) {
        campoEmail.value = emailDestinatario;
    } else {
        // Caso a pessoa entre direto na página sem clicar num usuário
        if(campoEmail) campoEmail.value = "destinatario@aluno.iffar.edu.br";
    }
});


// Função para o botão Enviar
window.enviarMensagem = function() {
    const mensagem = document.getElementById('texto-mensagem').value;


    if (mensagem.trim() === "") {
        alert("Por favor, digite uma mensagem antes de enviar!");
        return;
    }


    // Simulação de envio
    alert("Mensagem enviada com sucesso para: " + document.getElementById('email-destino').value);
   
    // Limpa o e-mail da memória para não bugar o próximo envio
    localStorage.removeItem('emailDestinatario');


    // Volta para a lista de usuários
    window.location.href = 'usuarios.html';
};

function login(){
alert("Login enviado!")
}

function toggleSenha(id, elemento){

let campo = document.getElementById(id);

if(campo.type === "password"){

campo.type = "text";
elemento.classList.remove("fa-eye-slash");
elemento.classList.add("fa-eye");

}else{

campo.type = "password";
elemento.classList.remove("fa-eye");
elemento.classList.add("fa-eye-slash");

}

}

/*
recuperar senha
*/

function enviarEmail(){

let email = document.getElementById("email").value;

if(email === ""){
alert("Digite seu e-mail institucional");
return;
}

window.location.href = "codigo_verificacao.html";

}

/*
codigo de verificacao
*/

const codes = document.querySelectorAll(".code")

if(codes.length > 0){

codes.forEach((input, index) => {

input.addEventListener("input", (e) => {

let value = e.target.value

// aceitar apenas números
value = value.replace(/[^0-9]/g, "")
input.value = value

// pular para próximo
if(value !== "" && index < codes.length - 1){
codes[index + 1].focus()
}

})

// voltar para o anterior ao apagar
input.addEventListener("keydown", (e) => {

if(e.key === "Backspace" && input.value === "" && index > 0){
codes[index - 1].focus()
}

})

})

// colar código completo
codes[0].addEventListener("paste", (e) => {

let paste = e.clipboardData.getData("text")
paste = paste.replace(/[^0-9]/g, "").split("")

codes.forEach((input, i) => {
if(paste[i]){
input.value = paste[i]
}
})

})

//nova senha 

function verificarCodigo(){

const codes = document.querySelectorAll(".code")

let codigo = ""

codes.forEach(input => {
codigo += input.value
})

if(codigo.length < 6){
alert("Digite o código completo")
return
}

// redireciona para nova senha
window.location.href = "nova_senha.html"

}

function salvarSenha(){

let senha = document.getElementById("novaSenha").value
let confirmar = document.getElementById("confirmarSenha").value

if(senha === "" || confirmar === ""){
alert("Preencha todos os campos")
return
}

if(senha !== confirmar){
alert("As senhas não coincidem")
return
}

alert("Senha redefinida com sucesso!")

// voltar para login
window.location.href = "login.html"

}

}
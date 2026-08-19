function toggleSenha(id, elemento) {
    let campo = document.getElementById(id);

    if (campo.type === "password") {
        campo.type = "text";
        elemento.classList.remove("fa-eye-slash");
        elemento.classList.add("fa-eye");
    } else {
        campo.type = "password";
        elemento.classList.remove("fa-eye");
        elemento.classList.add("fa-eye-slash");
    }
}

const codes = document.querySelectorAll(".code");

if (codes.length > 0) {
    codes.forEach((input, index) => {
        input.addEventListener("input", (e) => {
            let value = e.target.value;
            value = value.replace(/[^0-9]/g, "");
            input.value = value;

            if (value !== "" && index < codes.length - 1) {
                codes[index + 1].focus();
            }
        });

        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && input.value === "" && index > 0) {
                codes[index - 1].focus();
            }
        });
    });

    codes[0].addEventListener("paste", (e) => {
        let paste = e.clipboardData.getData("text");
        paste = paste.replace(/[^0-9]/g, "").split("");

        codes.forEach((input, i) => {
            if (paste[i]) {
                input.value = paste[i];
            }
        });
    });
}

const formCodigo = document.getElementById("formCodigo");

if (formCodigo) {
    formCodigo.addEventListener("submit", function () {
        let codigo = "";

        codes.forEach(input => {
            codigo += input.value;
        });

        document.getElementById("codigoCompleto").value = codigo;
    });
}
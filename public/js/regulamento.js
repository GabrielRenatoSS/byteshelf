const regulationStorageKey = "regulamento";

const defaultRules = [
    "Os componentes emprestados deverão ser entregues na data limite e nas mesmas condições de quando foram pegos; se for entregue fora do prazo, multas poderão ser aplicadas.",
    "Caso haja estragos ou perdas na devolução, a reposição do componente deve ser feita.",
    "Tenha noção em relação aos componentes pedidos, não abuse das quantidades desnecessariamente, pois outros usuários podem precisar; caso muitas unidades de um mesmo componente sejam solicitadas sem uma justificativa forte, haverá um motivo para recusa.",
    "Se seu pedido puder ser emprestado com exceção de um pequeno detalhe, o administrador pode sugerir uma edição; cabe você aceitá-la ou não. Se ela for recusada, o pedido será cancelado.",
    "Não faça pedidos inúteis ou muitos pedidos sem justificativa, pois os componentes também podem ser necessários para outros usuários."
];

let rules = readRules();
let editing = false;

function readRules() {
    try {
        const savedRules = JSON.parse(localStorage.getItem(regulationStorageKey));

        return Array.isArray(savedRules) && savedRules.length > 0
            ? savedRules
            : [...defaultRules];
    } catch {
        return [...defaultRules];
    }
}

function escapeHtml(value) {
    return String(value)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}

function renderAdministratorGreeting() {
    const greeting = document.querySelector("[data-administrator-greeting]");

    if (!greeting) return;

    try {
        const administrator = JSON.parse(localStorage.getItem("administradorDados")) || {};
        const firstName = String(administrator.nome || "")
            .trim()
            .split(/\s+/)[0];

        greeting.textContent = firstName ? `Olá, ${firstName}!` : "Olá!";
    } catch {
        greeting.textContent = "Olá!";
    }
}

function renderRules() {
    const card = document.getElementById("regulation-card");
    if (!card) return;

    card.innerHTML = `
        <ol class="regulation-list">
            ${rules.map((rule, index) => editing
                ? `<li><textarea data-rule="${index}" aria-label="Regra ${index + 1}">${escapeHtml(rule)}</textarea></li>`
                : `<li>${escapeHtml(rule)}</li>`
            ).join("")}
        </ol>
    `;

    const editButton = document.getElementById("edit-regulation-button");
    if (editButton) {
        editButton.innerHTML = editing
            ? '<i class="fa-solid fa-check" aria-hidden="true"><span>SALVAR</span>'
            : '<i class="fa-regular fa-pen-to-square" aria-hidden="true"><span>EDITAR</span>';
    }
}

function editarRegulamento() {
    if (editing) {
        rules = [...document.querySelectorAll("[data-rule]")]
            .map(field => field.value.trim())
            .filter(rule => rule !== "");

        localStorage.setItem(regulationStorageKey, JSON.stringify(rules));
    }

    editing = !editing;
    renderRules();
}

// Navegação ajustada para as views do Laravel (.blade.php)
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
renderRules();
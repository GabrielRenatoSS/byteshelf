let lastFocusedElement = null;

function formatDate(dateValue) {
    const [year, month, day] = dateValue.split("-");
    return `${day}/${month}/${year}`;
}

function getLoanDays(startDate, endDate) {
    const start = new Date(`${startDate}T00:00:00`);
    const end = new Date(`${endDate}T00:00:00`);
    return Math.round((end - start) / 86400000) + 1;
}

function updateLoanPeriod() {
    const startInput = document.getElementById("start-date");
    const endInput = document.getElementById("end-date");
    const startDate = startInput.value;
    const endDate = endInput.value;

    if (!startDate || !endDate) return;

    const totalDays = getLoanDays(startDate, endDate);
    const correctedDays = totalDays < 1 ? 1 : totalDays;
    const displayedEndDate = totalDays < 1 ? startDate : endDate;

    if (totalDays < 1) {
        endInput.value = startDate;
    }

    document.getElementById("date-range-text").textContent = `${formatDate(startDate)}  -  ${formatDate(displayedEndDate)}`;
    document.getElementById("day-count").textContent = `${correctedDays} ${correctedDays === 1 ? "dia" : "dias"}`;
    document.getElementById("date-range").setAttribute(
        "aria-label",
        `Período do empréstimo: ${formatDate(startDate)} a ${formatDate(displayedEndDate)}, ${correctedDays} ${correctedDays === 1 ? "dia" : "dias"}`
    );
}

function toggleDatePicker(forceOpen) {
    const picker = document.getElementById("date-picker");
    const trigger = document.getElementById("date-range");
    const shouldOpen = typeof forceOpen === "boolean" ? forceOpen : picker.hidden;

    picker.hidden = !shouldOpen;
    trigger.setAttribute("aria-expanded", String(shouldOpen));

    if (shouldOpen) document.getElementById("start-date").focus();
}

function openModal() {
    lastFocusedElement = document.activeElement;
    const modal = document.getElementById("loan-modal");
    modal.classList.add("is-open");
    modal.setAttribute("aria-hidden", "false");
    document.getElementById("confirm-request").focus();
}

function closeModal() {
    const modal = document.getElementById("loan-modal");
    modal.classList.remove("is-open");
    modal.setAttribute("aria-hidden", "true");
    lastFocusedElement?.focus();
}

function confirmRequest() {
    createLoanRequest();
    closeModal();

    const requestButton = document.getElementById("request-button");
    requestButton.textContent = "Empréstimo solicitado";
    requestButton.disabled = true;
}

function createLoanRequest() {
    const startDate = document.getElementById("start-date").value;
    const endDate = document.getElementById("end-date").value;
    const reason = document.getElementById("loan-reason").value.trim();

    let commonUser = {};
    let orders = [];

    try {
        commonUser = JSON.parse(localStorage.getItem("usuarioComumDados")) || {};
    } catch {
        commonUser = {};
    }

    try {
        const savedOrders = JSON.parse(localStorage.getItem("pedidosAdministrativos"));
        orders = Array.isArray(savedOrders) ? savedOrders : [];
    } catch {
        orders = [];
    }

    const request = {
        id: `pedido-${Date.now()}`,
        usuario: {
            nome: commonUser.nome || "Usuário",
            matricula: commonUser.matricula || ""
        },
        inicio: startDate,
        fim: endDate,
        status: "Solicitado",
        motivo: reason || "Não informado.",
        criadoEm: new Date().toISOString()
    };

    localStorage.setItem("pedidosAdministrativos", JSON.stringify([request, ...orders]));
}

function configureEvents() {
    const reason = document.getElementById("loan-reason");
    const characterCount = document.getElementById("character-count");
    if (reason && characterCount) {
        reason.addEventListener("input", () => {
            characterCount.textContent = `${reason.value.length}/300`;
        });
    }

    const dateRange = document.getElementById("date-range");
    if (dateRange) {
        dateRange.addEventListener("click", () => toggleDatePicker());
    }

    const startDate = document.getElementById("start-date");
    const endDate = document.getElementById("end-date");
    if (startDate) startDate.addEventListener("change", updateLoanPeriod);
    if (endDate) endDate.addEventListener("change", updateLoanPeriod);

    document.addEventListener("click", event => {
        const picker = document.getElementById("date-picker");
        const trigger = document.getElementById("date-range");

        if (picker && trigger && !picker.hidden && !picker.contains(event.target) && !trigger.contains(event.target)) {
            toggleDatePicker(false);
        }
    });

    const requestButton = document.getElementById("request-button");
    const cancelRequest = document.getElementById("cancel-request");
    const confirmRequestBtn = document.getElementById("confirm-request");
    const loanModal = document.getElementById("loan-modal");

    if (requestButton) requestButton.addEventListener("click", openModal);
    if (cancelRequest) cancelRequest.addEventListener("click", closeModal);
    if (confirmRequestBtn) confirmRequestBtn.addEventListener("click", confirmRequest);

    if (loanModal) {
        loanModal.addEventListener("click", event => {
            if (event.target.id === "loan-modal") closeModal();
        });
    }

    document.addEventListener("keydown", event => {
        if (event.key === "Escape") {
            const datePicker = document.getElementById("date-picker");
            if (datePicker && !datePicker.hidden) {
                toggleDatePicker(false);
            }
            if (loanModal && loanModal.classList.contains("is-open")) {
                closeModal();
            }
        }
    });
}

// Inicializações de UI que não dependem do localStorage do carrinho
updateLoanPeriod();
configureEvents();

// Atualizar o contador total de componentes com base no que veio do servidor ou somando os elementos
document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll(".cart-item-row");
    let totalQtd = 0;
    
    rows.forEach(row => {
        const qtdText = row.querySelector(".item-info strong");
        if (qtdText) {
            totalQtd += parseInt(qtdText.textContent) || 0;
        }
    });

    const totalElement = document.getElementById("component-total");
    if (totalElement) {
        totalElement.textContent = totalQtd;
    }
});
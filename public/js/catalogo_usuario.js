let selectedProduct = null;

function escapeHtml(value) {
    return String(value ?? "")
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}

function openProduct(cardElement) {
    if (!cardElement) return;

    // Recolhe os dados diretamente dos atributos do elemento HTML gerado pelo Blade
    const nome = cardElement.dataset.productName || "";
    const estoque = cardElement.dataset.productStock || "0";
    const imagem = cardElement.dataset.productImage || "";
    const descricao = cardElement.dataset.productDescription || "Nenhuma descrição informada.";

    const modalImage = document.getElementById("modalImagem");
    if (modalImage) {
        modalImage.src = imagem;
        modalImage.style.display = imagem ? "block" : "none";
    }

    const modalNome = document.getElementById("modalNome");
    if (modalNome) modalNome.textContent = nome || "Componente";

    const modalEstoque = document.getElementById("modalEstoque");
    if (modalEstoque) modalEstoque.textContent = `${Math.max(0, Number(estoque) || 0)} unidades em estoque`;

    const modalDescricao = document.getElementById("modalDescricao");
    if (modalDescricao) modalDescricao.textContent = descricao;

    const modal = document.getElementById("modalProduto");
    if (modal) {
        modal.style.display = "flex";
        modal.setAttribute("aria-hidden", "false");
    }
}

function closeProduct() {
    const modal = document.getElementById("modalProduto");
    if (modal) {
        modal.style.display = "none";
        modal.setAttribute("aria-hidden", "true");
    }
}

function irParaInicio() {
    window.location.href = "/inicio";
}

function sair() {
    window.location.href = "/login";
}

function irParaCatalogo() {
    window.location.href = "/catalogo";
}

function irParaPerfil() {
    window.location.href = "/dados_pessoais_usuario";
}

function irParaCarrinho() {
    window.location.href = "/carrinho";
}

document.addEventListener("DOMContentLoaded", () => {
    const catalog = document.getElementById("catalogo");
    
    if (catalog) {
        catalog.addEventListener("click", event => {
            const card = event.target.closest("[data-product-id]");
            if (card && !event.target.closest("[data-add-to-cart]")) {
                openProduct(card);
            }
        });

        catalog.addEventListener("keydown", event => {
            if ((event.key === "Enter" || event.key === " ") && event.target.matches("[data-product-id]")) {
                event.preventDefault();
                openProduct(event.target);
            }
        });
    }

    const closeProductBtn = document.querySelector("[data-close-product]");
    if (closeProductBtn) {
        closeProductBtn.addEventListener("click", closeProduct);
    }

    const modalProduto = document.getElementById("modalProduto");
    if (modalProduto) {
        modalProduto.addEventListener("click", event => {
            if (event.target.id === "modalProduto") closeProduct();
        });
    }

    document.addEventListener("keydown", event => {
        if (event.key === "Escape") closeProduct();
    });
});
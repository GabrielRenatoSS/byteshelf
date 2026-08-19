/* ================================================= */
/* PRODUTOS */
/* ================================================= */


let produtos =
    JSON.parse(localStorage.getItem("produtos")) || [];


let listaAtual = [...produtos];


let produtoSelecionado = null;


let imagensSelecionadas = [];


let quantidade = 0;


let filtroDanificadosAtivo = false;




/* ================================================= */
/* EDIÇÃO */
/* ================================================= */


let produtoEmEdicao = null;


let quantidadeEdicao = 0;


let imagensEdicao = [];




/* ================================================= */
/* CARREGAR CATÁLOGO */
/* ================================================= */


window.onload = function () {


    renderizarProdutos(produtos);


    configurarContadores();


    configurarContadoresEdicao();


    configurarImagensEdicao();


};




/* ================================================= */
/* RENDERIZAR PRODUTOS */
/* ================================================= */


function renderizarProdutos(lista) {


    const catalogo =
        document.getElementById("catalogo");


    if (!catalogo) return;


    catalogo.innerHTML = "";


    lista.forEach(produto => {


        const imagemPrincipal =
            produto.imagens &&
            produto.imagens.length > 0
                ? produto.imagens[0]
                : "";


        catalogo.innerHTML += `


            <div class="card">


                <div class="acoes-card">


                    <i
                        class="fa-solid fa-cart-plus"
                        title="Adicionar ao carrinho"
                        onclick="adicionarCarrinho(${produto.id}, event)">
                    </i>


                    <i
                        class="fa-regular fa-trash-can"
                        title="Excluir componente"
                        onclick="excluirProduto(${produto.id}, event)">
                    </i>


                    <i
                        class="fa-solid fa-pen"
                        title="Editar componente"
                        onclick="editarProduto(${produto.id}, event)">
                    </i>


                </div>




                ${
                    imagemPrincipal
                    ?
                    `
                        <img
                            src="${imagemPrincipal}"
                            alt="${produto.nome}"
                            onclick="abrirProduto(${produto.id})">
                    `
                    :
                    `
                        <div
                            class="sem-imagem"
                            onclick="abrirProduto(${produto.id})">


                            <i class="fa-regular fa-image"></i>


                        </div>
                    `
                }




                <div class="nomeProduto">
                    ${produto.nome}
                </div>




                <div class="estoque">
                    ${produto.estoque} un em estoque
                </div>


            </div>


        `;


    });


}




/* ================================================= */
/* PESQUISA */
/* ================================================= */


function pesquisarProduto() {


    const campo =
        document.getElementById(
            "campoPesquisa"
        );


    if (!campo) return;


    const texto =
        campo.value
            .toLowerCase()
            .trim();




    let lista = [...produtos];




    if (filtroDanificadosAtivo) {


        lista =
            lista.filter(produto =>
                produto.danificado === true
            );


    }




    if (texto !== "") {


        lista =
            lista.filter(produto =>
                produto.nome
                    .toLowerCase()
                    .includes(texto)
            );


    }




    listaAtual = lista;


    renderizarProdutos(listaAtual);


}




/* ================================================= */
/* CATEGORIAS */
/* ================================================= */


function filtrarCategoria(categoria, elemento) {


    document
        .querySelectorAll(".sidebar li")
        .forEach(item =>
            item.classList.remove("ativo")
        );




    if (elemento) {


        elemento.classList.add("ativo");


    }




    filtroDanificadosAtivo = false;




    let lista;




    if (categoria === "Todos") {


        lista = [...produtos];


    } else {


        lista =
            produtos.filter(produto =>
                produto.categoria === categoria
            );


    }




    const campo =
        document.getElementById(
            "campoPesquisa"
        );




    if (
        campo &&
        campo.value.trim() !== ""
    ) {


        const texto =
            campo.value
                .toLowerCase()
                .trim();




        lista =
            lista.filter(produto =>
                produto.nome
                    .toLowerCase()
                    .includes(texto)
            );


    }




    listaAtual = lista;


    renderizarProdutos(listaAtual);


}




/* ================================================= */
/* FILTRO DE DANIFICADOS */
/* ================================================= */


function filtrarDanificados() {


    filtroDanificadosAtivo =
        !filtroDanificadosAtivo;




    let lista = [...produtos];




    if (filtroDanificadosAtivo) {


        lista =
            lista.filter(produto =>
                produto.danificado === true
            );


    }




    const campo =
        document.getElementById(
            "campoPesquisa"
        );




    if (
        campo &&
        campo.value.trim() !== ""
    ) {


        const texto =
            campo.value
                .toLowerCase()
                .trim();




        lista =
            lista.filter(produto =>
                produto.nome
                    .toLowerCase()
                    .includes(texto)
            );


    }




    listaAtual = lista;


    renderizarProdutos(listaAtual);


}




/* ================================================= */
/* MODAL DO PRODUTO */
/* ================================================= */


function abrirProduto(id) {


    produtoSelecionado =
        produtos.find(
            produto => produto.id == id
        );




    if (!produtoSelecionado) return;




    const imagens =
        produtoSelecionado.imagens || [];




    const imagemModal =
        document.getElementById(
            "modalImagem"
        );




    if (imagemModal) {


        if (imagens.length > 0) {


            imagemModal.src =
                imagens[0];


            imagemModal.style.display =
                "block";


        } else {


            imagemModal.removeAttribute(
                "src"
            );


            imagemModal.style.display =
                "none";


        }


    }




    const nome =
        document.getElementById(
            "modalNome"
        );


    if (nome) {


        nome.textContent =
            produtoSelecionado.nome;


    }




    const descricao =
        document.getElementById(
            "modalDescricao"
        );


    if (descricao) {


        descricao.textContent =
            produtoSelecionado.descricao ||
            "Nenhuma descrição informada.";


    }




    const estoque =
        document.getElementById(
            "modalEstoque"
        );


    if (estoque) {


        estoque.textContent =
            produtoSelecionado.estoque +
            " unidades em estoque";


    }




    const modal =
        document.getElementById(
            "modalProduto"
        );


    if (modal) {


        modal.style.display =
            "flex";


    }


}




/* ================================================= */
/* FECHAR MODAL DO PRODUTO */
/* ================================================= */


function fecharProduto() {


    const modal =
        document.getElementById(
            "modalProduto"
        );


    if (modal) {


        modal.style.display =
            "none";


    }


}




/* ================================================= */
/* CARRINHO */
/* ================================================= */


function adicionarCarrinho(id, event) {


    if (event) {
        event.stopPropagation();
    }




    let carrinho =
        JSON.parse(
            localStorage.getItem(
                "carrinho"
            )
        ) || [];




    const produto =
        produtos.find(
            p => p.id == id
        );




    if (!produto) return;




    const existente =
        carrinho.find(
            p => p.id == id
        );




    if (existente) {


        existente.quantidade++;


    } else {


        carrinho.push({


            id: produto.id,


            nome: produto.nome,


            quantidade: 1


        });


    }




    localStorage.setItem(
        "carrinho",
        JSON.stringify(carrinho)
    );




    alert(
        "Produto adicionado ao carrinho!"
    );


}




/* ================================================= */
/* CARRINHO PELO MODAL */
/* ================================================= */


function adicionarCarrinhoModal() {


    if (!produtoSelecionado) return;


    adicionarCarrinho(
        produtoSelecionado.id
    );


}




/* ================================================= */
/* EXCLUIR PRODUTO */
/* ================================================= */


function excluirProduto(id, event) {


    if (event) {
        event.stopPropagation();
    }




    const produto =
        produtos.find(
            p => p.id == id
        );




    if (!produto) return;




    const confirmar =
        confirm(
            `Deseja excluir o componente "${produto.nome}"?`
        );




    if (!confirmar) return;




    produtos =
        produtos.filter(
            p => p.id != id
        );




    listaAtual =
        [...produtos];




    localStorage.setItem(
        "produtos",
        JSON.stringify(produtos)
    );




    renderizarProdutos(
        listaAtual
    );




    alert(
        "Componente excluído com sucesso!"
    );


}




/* ================================================= */
/* SAIR */
/* ================================================= */


function sair() {


    localStorage.removeItem(
        "emailDestinatario"
    );




    window.location.href =
        "../login/login.html";


}




/* ================================================= */
/* MODAL DE CADASTRO */
/* ================================================= */


function abrirCadastro() {


    const modal =
        document.getElementById(
            "modalCadastro"
        );




    if (!modal) return;




    modal.style.display =
        "flex";


}




function fecharCadastro() {


    const modal =
        document.getElementById(
            "modalCadastro"
        );




    if (!modal) return;




    modal.style.display =
        "none";


}




/* ================================================= */
/* QUANTIDADE DO CADASTRO */
/* ================================================= */


function aumentarQuantidade() {


    quantidade++;




    const campo =
        document.getElementById(
            "quantidade"
        );




    if (campo) {


        campo.value =
            quantidade;


    }


}




function diminuirQuantidade() {


    if (quantidade > 0) {


        quantidade--;


    }




    const campo =
        document.getElementById(
            "quantidade"
        );




    if (campo) {


        campo.value =
            quantidade;


    }


}




/* ================================================= */
/* EDITAR NOME DO CADASTRO */
/* ================================================= */


function editarNome() {


    const elemento =
        document.getElementById(
            "nomeComponente"
        );




    if (!elemento) return;




    const nomeAtual =
        elemento.textContent;




    const nome =
        prompt(
            "Nome do componente:",
            nomeAtual !==
            "Nome do Componente"
                ? nomeAtual
                : ""
        );




    if (
        nome &&
        nome.trim() !== ""
    ) {


        elemento.textContent =
            nome.trim();


    }


}




/* ================================================= */
/* CONTADORES DO CADASTRO */
/* ================================================= */


function configurarContadores() {


    const descricao =
        document.getElementById(
            "descricao"
        );




    const imagem =
        document.getElementById(
            "imagem"
        );




    if (descricao) {


        descricao.addEventListener(
            "input",
            function () {


                const contador =
                    document.getElementById(
                        "contadorTexto"
                    );




                if (contador) {


                    contador.textContent =
                        this.value.length;


                }


            }
        );


    }




    if (imagem) {


        imagem.addEventListener(
            "change",
            function () {


                const novosArquivos =
                    Array.from(
                        this.files
                    );




                if (
                    imagensSelecionadas.length +
                    novosArquivos.length >
                    4
                ) {


                    alert(
                        "Você pode selecionar no máximo 4 imagens."
                    );


                    this.value = "";


                    return;


                }




                imagensSelecionadas =
                    imagensSelecionadas.concat(
                        novosArquivos
                    );




                const contador =
                    document.getElementById(
                        "contadorImagem"
                    );




                if (contador) {


                    contador.textContent =
                        imagensSelecionadas.length +
                        "/4";


                }




                this.value = "";


            }
        );


    }


}




/* ================================================= */
/* CONVERTER IMAGEM */
/* ================================================= */


function converterImagemParaBase64(arquivo) {


    return new Promise(
        (resolve, reject) => {


            const leitor =
                new FileReader();




            leitor.onload =
                function () {


                    resolve(
                        leitor.result
                    );


                };




            leitor.onerror =
                function () {


                    reject(
                        new Error(
                            "Erro ao carregar a imagem."
                        )
                    );


                };




            leitor.readAsDataURL(
                arquivo
            );


        }
    );


}




/* ================================================= */
/* SALVAR COMPONENTE */
/* ================================================= */


async function salvarComponente() {


    const nome =
        document
            .getElementById(
                "nomeComponente"
            )
            .textContent
            .trim();




    const categoria =
        document
            .getElementById(
                "categoria"
            )
            .value;




    const descricao =
        document
            .getElementById(
                "descricao"
            )
            .value
            .trim();




    const danificado =
        document
            .getElementById(
                "danificado"
            )
            .checked;




    if (
        nome === "" ||
        nome === "Nome do Componente"
    ) {


        alert(
            "Informe o nome do componente."
        );


        return;


    }




    if (categoria === "") {


        alert(
            "Selecione uma categoria."
        );


        return;


    }




    if (quantidade <= 0) {


        alert(
            "Informe uma quantidade em estoque."
        );


        return;


    }




    let imagensBase64 = [];




    try {


        for (
            const arquivo of imagensSelecionadas
        ) {


            const imagem =
                await converterImagemParaBase64(
                    arquivo
                );




            imagensBase64.push(
                imagem
            );


        }


    } catch (erro) {


        console.error(erro);


        alert(
            "Não foi possível carregar uma das imagens."
        );


        return;


    }




    const novoId =
        produtos.length > 0
            ?
            Math.max(
                ...produtos.map(
                    produto => produto.id
                )
            ) + 1
            :
            1;




    const novoProduto = {


        id: novoId,


        nome: nome,


        categoria: categoria,


        estoque: quantidade,


        descricao:
            descricao !== ""
                ?
                descricao
                :
                "Nenhuma descrição informada.",


        imagens: imagensBase64,


        danificado: danificado


    };




    produtos.push(
        novoProduto
    );




    listaAtual =
        [...produtos];




    localStorage.setItem(
        "produtos",
        JSON.stringify(produtos)
    );




    renderizarProdutos(
        produtos
    );




    fecharCadastro();


    limparCadastro();




    alert(
        "Componente cadastrado com sucesso!"
    );


}




/* ================================================= */
/* LIMPAR CADASTRO */
/* ================================================= */


function limparCadastro() {


    quantidade = 0;


    imagensSelecionadas = [];




    const campoQuantidade =
        document.getElementById(
            "quantidade"
        );




    if (campoQuantidade) {


        campoQuantidade.value =
            "0";


    }




    const nome =
        document.getElementById(
            "nomeComponente"
        );




    if (nome) {


        nome.textContent =
            "Nome do Componente";


    }




    const categoria =
        document.getElementById(
            "categoria"
        );




    if (categoria) {


        categoria.value =
            "";


    }




    const descricao =
        document.getElementById(
            "descricao"
        );




    if (descricao) {


        descricao.value =
            "";


    }




    const danificado =
        document.getElementById(
            "danificado"
        );




    if (danificado) {


        danificado.checked =
            false;


    }




    const imagem =
        document.getElementById(
            "imagem"
        );




    if (imagem) {


        imagem.value =
            "";


    }




    const contadorTexto =
        document.getElementById(
            "contadorTexto"
        );




    if (contadorTexto) {


        contadorTexto.textContent =
            "0";


    }




    const contadorImagem =
        document.getElementById(
            "contadorImagem"
        );




    if (contadorImagem) {


        contadorImagem.textContent =
            "0/4";


    }


}




/* ================================================= */
/* EDITAR PRODUTO */
/* ================================================= */


function editarProduto(id, event) {


    if (event) {
        event.stopPropagation();
    }




    produtoEmEdicao =
        produtos.find(
            produto => produto.id == id
        );




    if (!produtoEmEdicao) {
        return;
    }




    /* NOME */


    const nome =
        document.getElementById(
            "nomeEdicao"
        );




    if (nome) {


        nome.textContent =
            produtoEmEdicao.nome;


    }




    /* CATEGORIA */


    const categoria =
        document.getElementById(
            "categoriaEdicao"
        );




    if (categoria) {


        categoria.value =
            produtoEmEdicao.categoria || "";


    }




    /* QUANTIDADE */


    quantidadeEdicao =
        Number(
            produtoEmEdicao.estoque
        ) || 0;




    const campoQuantidade =
        document.getElementById(
            "quantidadeEdicao"
        );




    if (campoQuantidade) {


        campoQuantidade.value =
            quantidadeEdicao;


    }




    /* DANIFICADO */


    const danificado =
        document.getElementById(
            "danificadoEdicao"
        );




    if (danificado) {


        danificado.checked =
            produtoEmEdicao.danificado === true;


    }




    /* DESCRIÇÃO */


    const descricao =
        document.getElementById(
            "descricaoEdicao"
        );




    if (descricao) {


        descricao.value =
            produtoEmEdicao.descricao || "";


    }




    const contadorTexto =
        document.getElementById(
            "contadorTextoEdicao"
        );




    if (contadorTexto) {


        contadorTexto.textContent =
            (
                produtoEmEdicao.descricao || ""
            ).length;


    }




    /* IMAGENS */


    imagensEdicao =
        produtoEmEdicao.imagens
            ?
            [...produtoEmEdicao.imagens]
            :
            [];




    const contadorImagem =
        document.getElementById(
            "contadorImagemEdicao"
        );




    if (contadorImagem) {


        contadorImagem.textContent =
            imagensEdicao.length +
            "/4";


    }




    const inputImagem =
        document.getElementById(
            "imagemEdicao"
        );




    if (inputImagem) {


        inputImagem.value = "";


    }




    /* ABRIR MODAL */


    const modal =
        document.getElementById(
            "modalEdicao"
        );




    if (modal) {


        modal.style.display =
            "flex";


    }


}




/* ================================================= */
/* QUANTIDADE DA EDIÇÃO */
/* ================================================= */


function aumentarQuantidadeEdicao() {


    quantidadeEdicao++;




    const campo =
        document.getElementById(
            "quantidadeEdicao"
        );




    if (campo) {


        campo.value =
            quantidadeEdicao;


    }


}




function diminuirQuantidadeEdicao() {


    if (quantidadeEdicao > 0) {


        quantidadeEdicao--;


    }




    const campo =
        document.getElementById(
            "quantidadeEdicao"
        );




    if (campo) {


        campo.value =
            quantidadeEdicao;


    }


}




/* ================================================= */
/* EDITAR NOME NA EDIÇÃO */
/* ================================================= */


function editarNomeEdicao() {


    const elemento =
        document.getElementById(
            "nomeEdicao"
        );




    if (!elemento) return;




    const novoNome =
        prompt(
            "Nome do componente:",
            elemento.textContent.trim()
        );




    if (
        novoNome !== null &&
        novoNome.trim() !== ""
    ) {


        elemento.textContent =
            novoNome.trim();


    }


}




/* ================================================= */
/* CONTADOR DA DESCRIÇÃO NA EDIÇÃO */
/* ================================================= */


function configurarContadoresEdicao() {


    const descricao =
        document.getElementById(
            "descricaoEdicao"
        );




    if (!descricao) return;




    descricao.addEventListener(
        "input",
        function () {


            const contador =
                document.getElementById(
                    "contadorTextoEdicao"
                );




            if (contador) {


                contador.textContent =
                    this.value.length;


            }


        }
    );


}




/* ================================================= */
/* IMAGENS DA EDIÇÃO */
/* ================================================= */


function configurarImagensEdicao() {


    const input = document.getElementById("imagemEdicao");


    if (!input) return;


    /* Permite selecionar várias imagens */
    input.multiple = true;


    /* ----------------------------------------- */
    /* QUANDO ESCOLHER NOVAS IMAGENS */
    /* ----------------------------------------- */


    input.addEventListener("change", function () {


        const arquivos = Array.from(this.files);


        if (arquivos.length === 0) {
            return;
        }


        /* Máximo de 4 imagens */
        if (arquivos.length > 4) {


            alert(
                "Você pode selecionar no máximo 4 imagens."
            );


            this.value = "";


            return;
        }


        /*
         * As imagens escolhidas substituem
         * as imagens antigas.
         */


        imagensEdicao = arquivos;


        /* Atualiza contador */


        const contador =
            document.getElementById(
                "contadorImagemEdicao"
            );


        if (contador) {


            contador.textContent =
                imagensEdicao.length + "/4";


        }


        /*
         * Limpa o input para permitir
         * selecionar novamente.
         */


        this.value = "";


    });




    /* ================================================= */
    /* GARANTIR QUE O QUADRADO ABRA O SELETOR */
    /* ================================================= */


    const upload = input.closest(".upload");


    if (upload) {


        upload.addEventListener("click", function (event) {


            /*
             * Se clicou no próprio input,
             * não faz nada.
             */


            if (event.target === input) {
                return;
            }


            input.click();


        });


    }


}


/* ================================================= */
/* INICIAR IMAGENS DA EDIÇÃO */
/* ================================================= */


document.addEventListener(
    "DOMContentLoaded",
    function () {


        configurarImagensEdicao();


    }
);


/* ================================================= */
/* CONVERTER IMAGEM DA EDIÇÃO */
/* ================================================= */


function converterImagemEdicao(arquivo) {


    return new Promise(
        (resolve, reject) => {


            const leitor =
                new FileReader();




            leitor.onload =
                function () {


                    resolve(
                        leitor.result
                    );


                };




            leitor.onerror =
                function () {


                    reject(
                        new Error(
                            "Erro ao carregar imagem."
                        )
                    );


                };




            leitor.readAsDataURL(
                arquivo
            );


        }
    );


}




/* ================================================= */
/* SALVAR EDIÇÃO */
/* ================================================= */


async function salvarEdicao() {


    if (!produtoEmEdicao) {
        return;
    }




    const nome =
        document
            .getElementById(
                "nomeEdicao"
            )
            .textContent
            .trim();




    const categoria =
        document
            .getElementById(
                "categoriaEdicao"
            )
            .value;




    const descricao =
        document
            .getElementById(
                "descricaoEdicao"
            )
            .value
            .trim();




    const danificado =
        document
            .getElementById(
                "danificadoEdicao"
            )
            .checked;




    if (
        nome === "" ||
        nome === "Nome do Componente"
    ) {


        alert(
            "Informe o nome do componente."
        );


        return;


    }




    if (categoria === "") {


        alert(
            "Selecione uma categoria."
        );


        return;


    }




    if (quantidadeEdicao < 0) {


        alert(
            "A quantidade não pode ser negativa."
        );


        return;


    }




    /* ----------------------------------------- */
    /* CONVERTER IMAGENS NOVAS */
    /* ----------------------------------------- */


    let imagensFinais = [];




    try {


        for (
            const imagem of imagensEdicao
        ) {


            if (
                typeof imagem === "string"
            ) {


                imagensFinais.push(
                    imagem
                );


            } else {


                const base64 =
                    await converterImagemEdicao(
                        imagem
                    );




                imagensFinais.push(
                    base64
                );


            }


        }


    } catch (erro) {


        console.error(erro);


        alert(
            "Não foi possível carregar uma das imagens."
        );


        return;


    }




    /* ----------------------------------------- */
    /* ATUALIZAR */
    /* ----------------------------------------- */


    produtoEmEdicao.nome =
        nome;




    produtoEmEdicao.categoria =
        categoria;




    produtoEmEdicao.estoque =
        quantidadeEdicao;




    produtoEmEdicao.descricao =
        descricao !== ""
            ?
            descricao
            :
            "Nenhuma descrição informada.";




    produtoEmEdicao.danificado =
        danificado;




    produtoEmEdicao.imagens =
        imagensFinais;




    /* ----------------------------------------- */
    /* SALVAR */
    /* ----------------------------------------- */


    localStorage.setItem(
        "produtos",
        JSON.stringify(produtos)
    );




    listaAtual =
        [...produtos];




    renderizarProdutos(
        listaAtual
    );




    fecharEdicao();




    alert(
        "Componente atualizado com sucesso!"
    );


}




/* ================================================= */
/* FECHAR EDIÇÃO */
/* ================================================= */


function fecharEdicao() {


    const modal =
        document.getElementById(
            "modalEdicao"
        );




    if (modal) {


        modal.style.display =
            "none";


    }




    produtoEmEdicao = null;


    imagensEdicao = [];


}




/* ================================================= */
/* LIMPAR PRODUTOS DE TESTE */
/* ================================================= */


function limparProdutosTeste() {


    localStorage.removeItem(
        "produtos"
    );




    produtos = [];


    listaAtual = [];




    renderizarProdutos([]);




    alert(
        "Produtos antigos removidos."
    );


}




/* ================================================= */
/* FECHAR MODAIS CLICANDO FORA */
/* ================================================= */


window.addEventListener(
    "click",
    function (event) {


        const modalProduto =
            document.getElementById(
                "modalProduto"
            );




        const modalCadastro =
            document.getElementById(
                "modalCadastro"
            );




        const modalEdicao =
            document.getElementById(
                "modalEdicao"
            );




        if (
            modalProduto &&
            event.target === modalProduto
        ) {


            fecharProduto();


        }




        if (
            modalCadastro &&
            event.target === modalCadastro
        ) {


            fecharCadastro();


        }




        if (
            modalEdicao &&
            event.target === modalEdicao
        ) {


            fecharEdicao();


        }


    }
);


/* ================================================= */
/* MOSTRAR / OCULTAR DESCRIÇÃO */
/* ================================================= */


function alternarDescricao() {


    const descricao = document.querySelector(
        ".modal-direita .descricao-cadastro"
    );


    if (!descricao) return;


    descricao.classList.toggle("aberta");


}


/* ================================================= */
/* NAVEGAÇÃO */
/* ================================================= */


function home() {
    window.location.href='{{ route(inicio) }}';
}


function catalogo() {
    window.location.href='{{ route(catalogo) }}';
}


function perfil() {
    window.location.href='{{ route(perfil) }}';
}


function carrinho() {
    window.location.href = "../carrinho/carrinho.html";
}

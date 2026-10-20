<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ByteShelf - Carrinho de empréstimos</title>

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header class="top-nav cart-top-nav">
    <a class="logo-container" href="{{ route('home') }}" aria-label="Ir para o início">
        <img src="{{ asset('assets/logo_retangular_azul.jpeg') }}" class="main-logo" alt="ByteShelf">
    </a>

    <nav class="nav-icons" aria-label="Navegação principal">
        <a href="{{ route('home') }}" title="Início" aria-label="Início">
            <i class="fa-solid fa-house"></i>
        </a>
        <a href="{{ route('login') }}" title="Sair" aria-label="Sair">
            <i class="fa-solid fa-right-from-bracket"></i>
        </a>
        <a href="{{ route('catalogo') }}" title="Catálogo" aria-label="Catálogo">
            <i class="fa-solid fa-book-open"></i>
        </a>
        <a href="{{ route('perfil') }}" title="Perfil" aria-label="Perfil">
            <i class="fa-solid fa-user"></i>
        </a>
        <a href="{{ route('carrinho') }}" class="is-current" title="Carrinho de empréstimos" aria-label="Carrinho de empréstimos">
            <i class="fa-solid fa-cart-shopping"></i>
        </a>
    </nav>
</header>

    <main class="loan-cart">
        <h1>Meu carrinho de Empréstimos</h1>

        <div class="cart-layout">
            <section class="cart-items" id="cart-items" aria-label="Componentes selecionados">
    @forelse($componentes as $componente)
        @php
            $qtd = $carrinho[$componente->id]['quantidade'] ?? 1;
        @endphp
        <div class="cart-item-row" data-id="{{ $componente->id }}">
            <div class="item-info">
                @if(isset($componente->foto))
                    <img src="{{ asset($componente->foto) }}" alt="{{ $componente->nome }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                @else
                    <i class="fa-solid fa-microchip" style="font-size: 40px;"></i>
                @endif
                <div>
                    <h3>{{ $componente->nome }}</h3>
                    <p>Quantidade: <strong>{{ $qtd }}</strong></p>
                </div>
            </div>

            <form action="{{ route('carrinho.remover', $componente->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-remove-item" title="Remover item">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    @empty
        <p class="cart-empty" style="text-align: center; padding: 30px;">O seu carrinho de empréstimos está vazio.</p>
    @endforelse
</section>

            <aside class="order-summary" aria-labelledby="summary-title">
                <h2 id="summary-title">Resumo do Pedido</h2>

                <p class="component-total">Quantidade de componentes: <strong id="component-total">0</strong></p>

                <div class="period-section">
                    <p>Deseja ficar com os componentes entre os dias:</p>
                    <button type="button" class="date-range" id="date-range" aria-haspopup="dialog" aria-expanded="false" aria-controls="date-picker">
                        <i class="fa-regular fa-calendar-days" aria-hidden="true"></i>
                        <span id="date-range-text">14/12/2025&nbsp;&nbsp;-&nbsp;&nbsp;17/12/2025</span>
                        <strong id="day-count">4 dias</strong>
                    </button>
                    <div class="date-picker" id="date-picker" role="dialog" aria-label="Escolher período do empréstimo" hidden>
                        <label for="start-date">Data de retirada
                            <input type="date" id="start-date" value="2025-12-14">
                        </label>
                        <label for="end-date">Data de devolução
                            <input type="date" id="end-date" value="2025-12-17">
                        </label>
                    </div>
                </div>

                <label for="loan-reason">Motivo do empréstimo:</label>
                <div class="reason-field">
                    <textarea id="loan-reason" maxlength="300" placeholder="Insira aqui o motivo do empréstimo..."></textarea>
                    <span id="character-count">0/300</span>
                </div>

                <button type="button" class="request-button" id="request-button">Solicitar empréstimo</button>
            </aside>
        </div>
    </main>

    <div class="loan-modal" id="loan-modal" aria-hidden="true">
        <div class="modal-panel" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <h2 id="modal-title">Você tem certeza que deseja<br>solicitar o empréstimo?</h2>
            <div class="modal-actions">
                <button type="button" class="modal-action" id="confirm-request">
                    <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                    <span>SOLICITAR</span>
                </button>
                <button type="button" class="modal-action" id="cancel-request">
                    <i class="fa-solid fa-arrow-left-long" aria-hidden="true"></i>
                    <span>VOLTAR</span>
                </button>
            </div>
        </div>
    </div>

    <div class="item-removal-modal" id="item-removal-modal" aria-hidden="true">
        <div class="item-removal-panel" role="dialog" aria-modal="true" aria-labelledby="item-removal-title">
            <h2 id="item-removal-title">Remover item?</h2>
            <p id="item-removal-text">Deseja remover este componente do carrinho?</p>
            <div class="item-removal-actions">
                <button type="button" class="item-removal-cancel" id="cancel-item-removal">Cancelar</button>
                <button type="button" class="item-removal-confirm" id="confirm-item-removal">Remover</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/carrinho.js') }}"></script>
</body>
</html>

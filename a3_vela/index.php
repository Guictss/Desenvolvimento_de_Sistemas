<?php
session_start();

// Se o usuário já está logado, redireciona para o sistema
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programa Vela Para Todos · FBVA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/landing.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>

<body>

<!-- ── Faixa decorativa superior (padrão amarelo) ────────────────────────── -->
<div class="pattern-top"></div>

<!-- ── Barra de Acessibilidade ──────────────────────────────────────────── -->
<div class="acess-toolbar" id="acessToolbar">
    <button onclick="ajustarFonte(0.1)"  title="Aumentar fonte" aria-label="Aumentar fonte">A+</button>
    <button onclick="ajustarFonte(-0.1)" title="Diminuir fonte" aria-label="Diminuir fonte">A−</button>
    <button onclick="toggleContraste()"  title="Alto contraste" aria-label="Alto contraste">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18V4c4.41 0 8 3.59 8 8s-3.59 8-8 8z"/></svg>
    </button>
    <button onclick="resetarAcessibilidade()" title="Restaurar padrão" aria-label="Restaurar padrão">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z"/></svg>
    </button>
</div>

<!-- ── Header / Navbar ───────────────────────────────────────────────────── -->
<header class="header-landing">
    <div class="container d-flex justify-content-between align-items-center py-3">
        <a href="index.php">
            <img src="assets/img/logo-horizontal.png" alt="Vela Para Todos" class="logo-header">
        </a>

        <nav class="d-none d-lg-flex gap-4 align-items-center">
            <a href="#sobre"        class="nav-link-vela">Informações</a>
            <a href="#quem-somos"   class="nav-link-vela">Quem somos</a>
            <a href="#acessibilidade" class="nav-link-vela">Acessibilidade</a>
            <a href="#contato"      class="nav-link-vela">Contato</a>
        </nav>

        <a href="login.php" class="btn btn-vela-azul px-4 py-2 fw-bold">Login</a>
    </div>
</header>

<!-- ── Hero ──────────────────────────────────────────────────────────────── -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container position-relative text-center text-white py-5">
        <h1 class="display-4 fw-bold mb-4 hero-title">
            Conheça e participe do<br>Projeto Vela Para Todos!
        </h1>
        <a href="#sobre" class="btn btn-vela-azul btn-lg px-5 py-3 fw-bold">Saiba mais</a>
    </div>
</section>

<!-- ── Cards: Infraestrutura e Sobre a modalidade ────────────────────────── -->
<section class="py-5" id="sobre">
    <div class="container">
        <div class="row g-4">

            <div class="col-md-6">
                <div class="card card-vela h-100 shadow-sm">
                    <div class="card-img-vela" style="background-image: url('assets/img/infraestrutura.jpg');"></div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3" style="color: var(--azul-dark);">Infraestrutura</h4>
                        <p style="color: var(--gray);">
                            Contamos com uma infraestrutura completa, com barcos adaptados, 
                            profissionais preparados e restaurantes de ótima qualidade...
                        </p>
                        <a href="#" class="text-decoration-none fw-semibold" style="color: var(--azul);">
                            Saiba mais →
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-vela h-100 shadow-sm">
                    <div class="card-img-vela" style="background-image: url('assets/img/modalidade.jpg');"></div>
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3" style="color: var(--azul-dark);">Sobre a modalidade</h4>
                        <p style="color: var(--gray);">
                            "A modalidade pode ser praticada por qualquer deficiente físico e tem 
                            o modo de competição e as regras idênticas a vela regular."
                        </p>
                        <a href="#" class="text-decoration-none fw-semibold" style="color: var(--azul);">
                            Saiba mais →
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ── Seção Mascote / Quem somos ────────────────────────────────────────── -->
<section class="py-5" id="quem-somos" style="background-color: var(--light-blue);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-5 text-center">
                <div class="mascote-wrapper" id="zoeWrapper">
                    <div class="mascote-inner">
                        <img src="assets/img/mascote.png" alt="Zoe - mascote do projeto" class="mascote-img">
                    </div>
                    <div class="zoe-bubble" id="zoeBubble">Olá! Sou a Zoe 👋</div>
                    <span class="sparkle">✨</span>
                    <span class="sparkle">⭐</span>
                    <span class="sparkle">✨</span>
                    <span class="sparkle">💫</span>
                </div>
            </div>
            <div class="col-md-7">
                <h2 class="fw-bold mb-3" style="color: var(--azul-dark);">Conheça a Zoe!</h2>
                <p class="fs-5" style="color: var(--gray);">
                    Zoe é a mascote do Programa Vela Para Todos. Inspirada na liberdade dos pássaros 
                    e na força do vento que move as velas, ela representa a missão do projeto: 
                    levar a alegria de velejar para todas as pessoas, sem exceção.
                </p>
                <p class="fs-5" style="color: var(--gray);">
                    Junte-se a nós nessa jornada por mais inclusão, autonomia e esporte adaptado.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ── Seção Notícias ────────────────────────────────────────────────────── -->
<section class="noticias-section py-5">
    <div class="container">
        <h2 class="text-center text-white fw-bold mb-5">Notícias</h2>
        <div class="row g-4">

            <div class="col-md-4">
                <div class="card card-noticia h-100 shadow">
                    <div class="card-img-noticia" style="background-image: url('assets/img/noticia-1.jpg');"></div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3" style="color: var(--azul-dark);">Projeto social ensina pessoas com deficiência a velejar</h5>
                        <p class="small" style="color: var(--gray);">
                            A TV Record Brasília exibiu uma reportagem no programa DF no AR sobre o 
                            projeto social Vela Para Todos.
                        </p>
                        <a href="#" class="text-decoration-none fw-semibold" style="color: var(--azul);">Saiba mais →</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-noticia h-100 shadow">
                    <div class="card-img-noticia" style="background-image: url('assets/img/noticia-2.jpg');"></div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3" style="color: var(--azul-dark);">Lago Paranoá recebe Copa BRB da Vela Adaptada</h5>
                        <p class="small" style="color: var(--gray);">
                            Competição para pessoas com deficiência será realizada neste sábado, 
                            na Semana da Pessoa com Deficiência.
                        </p>
                        <a href="#" class="text-decoration-none fw-semibold" style="color: var(--azul);">Saiba mais →</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-noticia h-100 shadow">
                    <div class="card-img-noticia" style="background-image: url('assets/img/noticia-3.jpg');"></div>
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3" style="color: var(--azul-dark);">Brasiliense é a primeira brasileira campeã mundial de vela adaptada</h5>
                        <p class="small" style="color: var(--gray);">
                            Do Correio Braziliense — A gaúcha radicada em Brasília Ana Paula Marques 
                            se tornou campeã mundial aos 35 anos.
                        </p>
                        <a href="#" class="text-decoration-none fw-semibold" style="color: var(--azul);">Saiba mais →</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ── Seção Acessibilidade ──────────────────────────────────────────────── -->
<section class="acessibilidade-section py-5" id="acessibilidade">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2" style="color: var(--azul-dark);">Acessibilidade e Inclusão</h2>
            <p class="lead text-muted">Nosso compromisso é fazer com que todos possam navegar e participar</p>
        </div>

        <div class="row g-4">

            <div class="col-lg-6">
                <p class="fs-5" style="color: var(--gray);">
                    A acessibilidade digital é parte fundamental da missão do <strong>Programa Vela Para Todos</strong>. 
                    Acreditamos que a inclusão começa muito antes do contato com a água — começa na forma como as 
                    pessoas com deficiência acessam, compreendem e interagem com nossas informações.
                </p>
                <p class="fs-5" style="color: var(--gray);">
                    Este site segue as diretrizes da <strong>Lei Brasileira de Inclusão (LBI 13.146/2015)</strong> e 
                    as recomendações do <strong>WCAG 2.1</strong>, padrão internacional de acessibilidade na web. 
                    Trabalhamos continuamente para que nossa plataforma seja utilizável por todas as pessoas, 
                    independentemente de suas habilidades.
                </p>
            </div>

            <div class="col-lg-6">
                <div class="acess-recursos">
                    <h5 class="fw-bold mb-4" style="color: var(--azul-dark);">Recursos disponíveis</h5>

                    <div class="recurso-item">
                        <div class="recurso-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1D71B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 18.5a3.5 3.5 0 1 0 7 0c0-1.57.92-2.52 2.04-3.46"/>
                                <path d="M6 8.5c0-.83.67-1.5 1.5-1.5h1c.83 0 1.5.67 1.5 1.5v0"/>
                                <path d="M10 13.5c0-.83.67-1.5 1.5-1.5h1c.83 0 1.5.67 1.5 1.5v0"/>
                                <path d="M14 8.5c0-.83.67-1.5 1.5-1.5h1c.83 0 1.5.67 1.5 1.5v0"/>
                            </svg>
                        </div>
                        <div>
                            <strong>Tradução em Libras (VLibras)</strong>
                            <p>Tradutor automático para Língua Brasileira de Sinais. Clique no ícone azul no canto da página.</p>
                        </div>
                    </div>

                    <div class="recurso-item">
                        <div class="recurso-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="#1D71B8"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18V4c4.41 0 8 3.59 8 8s-3.59 8-8 8z"/></svg>
                        </div>
                        <div>
                            <strong>Alto contraste</strong>
                            <p>Aumente o contraste visual da página para facilitar a leitura.</p>
                        </div>
                    </div>

                    <div class="recurso-item">
                        <div class="recurso-icon" style="font-weight: 800; color: var(--azul); font-size: 1.1rem;">
                            A+
                        </div>
                        <div>
                            <strong>Ajuste de fonte</strong>
                            <p>Aumente ou diminua o tamanho do texto conforme sua necessidade.</p>
                        </div>
                    </div>

                    <div class="recurso-item">
                        <div class="recurso-icon">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1D71B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 12l2 2 4-4"/>
                                <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                                <path d="M3 5c0-1.66 4-3 9-3s9 1.34 9 3-4 3-9 3-9-1.34-9-3z"/>
                            </svg>
                        </div>
                        <div>
                            <strong>Navegação por teclado</strong>
                            <p>Todo o site é navegável apenas com a tecla Tab e atalhos de teclado.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ── Seção Contato com Mapa ─────────────────────────────────────────────── -->
<section class="contato-section py-5" id="contato">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2" style="color: var(--azul-dark);">Onde estamos</h2>
            <p class="lead text-muted">Venha nos visitar no Clube Cultural e Recreativo Nipo Brasileiro</p>
        </div>

        <div class="row g-4 align-items-stretch">

            <!-- Mapa -->
            <div class="col-lg-7">
                <div id="mapa-vela" class="contato-mapa"></div>
            </div>

            <!-- Info de contato -->
            <div class="col-lg-5">
                <div class="contato-info h-100">

    <div class="info-item">
        <div class="info-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1D71B8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
            </svg>
        </div>
        <div>
            <strong>Endereço</strong>
            <p>Clube Cultural e Recreativo Nipo Brasileiro<br>
            SCES Sul, Trecho 1, Lote 1 · Brasília-DF</p>
        </div>
    </div>

    <div class="info-item">
        <div class="info-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1D71B8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
        </div>
        <div>
            <strong>Telefone</strong>
            <p>(61) 99962-9868</p>
        </div>
    </div>

    <div class="info-item">
        <div class="info-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1D71B8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
        </div>
        <div>
            <strong>E-mail</strong>
            <p>contato@fbva.esp.br</p>
        </div>
    </div>

    <div class="info-item">
        <div class="info-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1D71B8" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
        </div>
        <div>
            <strong>Horário de funcionamento</strong>
            <p>Terça a domingo, das 8h às 17h</p>
        </div>
    </div>

    <a href="https://www.google.com/maps/dir/?api=1&destination=-15.8164,-47.8775" 
       target="_blank" class="btn-vela-azul w-100 mt-3 d-block text-center fw-bold py-3">
        Como chegar
    </a>

</div>
                
            </div>

        </div>
    </div>
</section>

<!-- ── Footer ────────────────────────────────────────────────────────────── -->
<footer class="footer-landing py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <img src="assets/img/logo-horizontal.png" alt="Vela Para Todos" class="logo-footer">
            </div>
            <div class="col-md-6 text-center text-md-end text-white">
                <p class="mb-1"><strong>(61) 99962-9868</strong></p>
                <p class="mb-1">contato@fbva.esp.br</p>
                <p class="mb-0 small opacity-75">
                    Clube Cultural e Recreativo Nipo Brasileiro<br>
                    St. de Clubes Esportivos Sul, Trecho 1, Lote 1 · Brasília
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- ── Faixa decorativa inferior ─────────────────────────────────────────── -->
<div class="pattern-bottom"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const wrapper = document.getElementById('zoeWrapper');
    if (!wrapper) return;

    const inner  = wrapper.querySelector('.mascote-inner');
    const bubble = document.getElementById('zoeBubble');

    const mensagens = [
        'Olá! Sou a Zoe ',
        'Bora velejar? ',
        'Vento a favor! ',
        'Você é incrível! ',
        'Vamos juntos! '
    ];
    let msgIndex = 0;

    document.addEventListener('mousemove', (e) => {
        if (wrapper.classList.contains('spinning')) return;
        const rect = wrapper.getBoundingClientRect();
        if (rect.bottom < 0 || rect.top > window.innerHeight) return;
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        const rotY = Math.max(-15, Math.min(15, ((e.clientX - centerX) / window.innerWidth) * 30));
        const rotX = Math.max(-10, Math.min(10, ((centerY - e.clientY) / window.innerHeight) * 20));
        inner.style.transform = `rotateY(${rotY}deg) rotateX(${rotX}deg)`;
    });

    document.addEventListener('mouseleave', () => {
        inner.style.transform = '';
    });

    wrapper.addEventListener('click', () => {
        if (wrapper.classList.contains('spinning')) return;
        wrapper.classList.add('spinning');
        msgIndex = (msgIndex + 1) % mensagens.length;
        bubble.textContent = mensagens[msgIndex];
        setTimeout(() => wrapper.classList.remove('spinning'), 900);
    });
});
</script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mapaEl = document.getElementById('mapa-vela');
    if (!mapaEl) return;

    const lat = -15.8164;
    const lng = -47.8775;

    const mapa = L.map('mapa-vela', {
        center: [lat, lng],
        zoom: 16,
        minZoom: 13,        // limite máximo de zoom-out
        maxZoom: 18,        // limite máximo de zoom-in
        maxBounds: [        // limita o pan dentro da área de Brasília
            [-15.90, -47.95],
            [-15.73, -47.80]
        ],
        maxBoundsViscosity: 1.0
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap',
        noWrap: true,       // impede o mundo de se repetir
        bounds: [           // só carrega tiles dentro da área válida
            [-90, -180],
            [90, 180]
        ]
    }).addTo(mapa);

    const iconeVela = L.divIcon({
        className: 'marcador-vela',
        html: `<div style="
            background: linear-gradient(135deg, #1D71B8, #19629E);
            width: 40px; height: 40px;
            border-radius: 50% 50% 50% 0;
            transform: rotate(-45deg);
            border: 3px solid #F9B233;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            display: flex; align-items: center; justify-content: center;
        ">
            <span style="transform: rotate(45deg); font-size: 1.2rem;">⛵</span>
        </div>`,
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -38]
    });

    L.marker([lat, lng], { icon: iconeVela })
        .addTo(mapa)
        .bindPopup(`
            <strong>Programa Vela Para Todos</strong><br>
            Clube Cultural e Recreativo Nipo Brasileiro<br>
            SCES Sul, Trecho 1 · Brasília-DF
        `)
        .openPopup();
});
</script>

<script>
// ── Acessibilidade: fonte e contraste ──────────────────────────────────────
let tamanhoFonte = parseFloat(localStorage.getItem('vela_fonte') || 1);
let altoContraste = localStorage.getItem('vela_contraste') === 'true';

function aplicarFonte() {
    document.documentElement.style.fontSize = (16 * tamanhoFonte) + 'px';
    localStorage.setItem('vela_fonte', tamanhoFonte);
}

function ajustarFonte(delta) {
    tamanhoFonte = Math.max(0.8, Math.min(1.5, tamanhoFonte + delta));
    aplicarFonte();
}

function toggleContraste() {
    altoContraste = !altoContraste;
    document.body.classList.toggle('alto-contraste', altoContraste);
    localStorage.setItem('vela_contraste', altoContraste);
}

function resetarAcessibilidade() {
    tamanhoFonte = 1;
    altoContraste = false;
    document.body.classList.remove('alto-contraste');
    aplicarFonte();
    localStorage.removeItem('vela_contraste');
}

// Restaurar preferências ao carregar
if (tamanhoFonte !== 1) aplicarFonte();
if (altoContraste) document.body.classList.add('alto-contraste');
</script>

<!-- ── VLibras: Tradutor de Libras (Governo Federal) ────────────────────── -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

</body>
</html>
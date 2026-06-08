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
</head>

<body>

<!-- ── Faixa decorativa superior (padrão amarelo) ────────────────────────── -->
<div class="pattern-top"></div>

<!-- ── Header / Navbar ───────────────────────────────────────────────────── -->
<header class="header-landing">
    <div class="container d-flex justify-content-between align-items-center py-3">
        <a href="index.php">
            <img src="assets/img/logo-horizontal.png" alt="Vela Para Todos" class="logo-header">
        </a>

        <nav class="d-none d-lg-flex gap-4 align-items-center">
            <a href="#sobre"        class="nav-link-vela">Informações</a>
            <a href="#quem-somos"   class="nav-link-vela">Quem somos</a>
            <a href="#apoiadores"   class="nav-link-vela">Apoiadores</a>
            <a href="#acessibilidade" class="nav-link-vela">Acessibilidade</a>
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

</body>
</html>
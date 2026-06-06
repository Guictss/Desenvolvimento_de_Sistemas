<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo) ? $titulo . ' · ' : '' ?>Vela Para Todos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo isset($base) ? $base : '' ?>assets/css/style.css">
</head>
<body>

<nav class="navbar-vela">
    <div class="navbar-vela-inner">

        <a href="<?php echo isset($base) ? $base : '' ?>painel.php" class="navbar-brand-vela">
            <img src="<?php echo isset($base) ? $base : '' ?>assets/img/logo-horizontal.png" 
                 alt="Vela Para Todos" class="navbar-logo">
        </a>

        <div class="navbar-actions">

            <?php if ($_SESSION['papel'] === 'aluno'): ?>
                <a href="<?php echo isset($base) ? $base : '' ?>inscricoes.php" 
                   class="nav-btn">Minhas Inscrições</a>
            <?php endif; ?>

            <?php if ($_SESSION['papel'] === 'professor'): ?>
                <a href="<?php echo isset($base) ? $base : '' ?>usuarios.php" class="nav-btn">👥 Usuários</a>
                <a href="<?php echo isset($base) ? $base : '' ?>doacoes.php" class="nav-btn">💰 Doações</a>
                <a href="<?php echo isset($base) ? $base : '' ?>relatorio/relatorio_inscricoes.php"
                   class="nav-btn" target="_blank">📄 Relatório</a>
            <?php endif; ?>

            <div class="user-info">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($_SESSION['usuario'], 0, 1)) ?>
                </div>
                <div class="user-details">
                    <div class="user-name"><?php echo $_SESSION['usuario'] ?></div>
                    <span class="badge <?php echo $_SESSION['papel'] === 'professor' ? 'badge-professor' : 'badge-aluno' ?>">
                        <?php echo ucfirst($_SESSION['papel']) ?>
                    </span>
                </div>
            </div>

            <a href="<?php echo isset($base) ? $base : '' ?>logout.php" class="btn-sair">Sair</a>

        </div>
    </div>
</nav>

<div class="container mt-4">
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

<nav class="navbar navbar-dark navbar-vela px-4 py-3">
    <a class="navbar-brand fw-bold fs-5" href="<?php echo isset($base) ? $base : '' ?>index.php">
        ⛵ Vela Para Todos
    </a>
    <div class="d-flex align-items-center gap-3">
        <?php if ($_SESSION['papel'] === 'aluno'): ?>
            <a href="<?php echo isset($base) ? $base : '' ?>inscricoes.php" 
               class="btn btn-outline-light btn-sm">Minhas Inscrições</a>
        <?php endif; ?>
        <?php if ($_SESSION['papel'] === 'professor'): ?>
            <a href="<?php echo isset($base) ? $base : '' ?>usuarios.php" 
                class="btn btn-outline-light btn-sm">👥 Usuários</a>
            <a href="<?php echo isset($base) ? $base : '' ?>doacoes.php" 
                class="btn btn-outline-light btn-sm">💰 Doações</a>
            <a href="<?php echo isset($base) ? $base : '' ?>relatorio/relatorio_inscricoes.php"
                class="btn btn-outline-light btn-sm" target="_blank">📄 Relatório</a>
        <?php endif; ?>
        <span class="text-white">
            Olá, <strong><?php echo $_SESSION['usuario'] ?></strong>
            <span class="badge ms-1 <?php echo $_SESSION['papel'] === 'professor' ? 'badge-professor' : 'badge-aluno' ?>">
                <?php echo ucfirst($_SESSION['papel']) ?>
            </span>
        </span>
        <a href="<?php echo isset($base) ? $base : '' ?>logout.php" class="btn btn-outline-light btn-sm">Sair</a>
    </div>
</nav>

<div class="container mt-4">
<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <!-- FRAMEWORK: Bootstrap 5 | Importado via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-4 mb-4">
        <span class="navbar-brand">📋 Tarefas</span>
        <?php if (isset($_SESSION['usuario'])): ?>
            <span class="text-white me-3">Olá, <strong><?php echo $_SESSION['usuario'] ?></strong></span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Sair</a>
        <?php endif; ?>
    </nav>
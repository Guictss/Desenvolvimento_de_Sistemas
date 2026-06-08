<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header('Location: painel.php');
    exit;
}

include 'conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha   = md5($_POST['senha']);

    $sql  = "SELECT * FROM usuarios WHERE email = :usuario AND senha = :senha";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha',   $senha);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $_SESSION['usuario_id'] = $user->id;
        $_SESSION['usuario']    = $user->nome;
        $_SESSION['papel']      = $user->papel;
        header('Location: painel.php');
        exit;
    } else {
        $erro = 'E-mail ou senha incorretos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · Vela Para Todos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>

<div class="auth-container">

    <!-- ── Coluna visual (esquerda) ───────────────────────────────────── -->
    <div class="auth-visual">
        <div class="auth-pattern"></div>
        <div class="auth-content">
            <img src="assets/img/logo-vertical.png" alt="Vela Para Todos" class="auth-logo">
            <img src="assets/img/mascote.png" alt="Zoe" class="auth-mascote">
            <h3 class="fw-bold mb-2 text-white">Bem-vindo de volta!</h3>
            <p class="text-white opacity-75 px-4">
                Acesse sua conta e continue navegando rumo à inclusão pelo esporte.
            </p>
        </div>
    </div>

    <!-- ── Coluna do formulário (direita) ─────────────────────────────── -->
    <div class="auth-form">
        <div class="auth-form-inner">

            <a href="index.php" class="text-decoration-none mb-4 d-inline-block" style="color: var(--gray);">
                ← Voltar ao início
            </a>

            <h2 class="fw-bold mb-2" style="color: var(--azul-dark);">Acesse sua conta</h2>
            <p class="text-muted mb-4">Entre com seus dados para continuar</p>

            <?php if ($erro): ?>
                <div class="alert alert-danger py-2"><?php echo $erro ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label fw-semibold">E-mail</label>
                    <input type="email" name="usuario" class="form-control form-control-lg"
                           placeholder="seu@email.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Senha</label>
                    <input type="password" name="senha" class="form-control form-control-lg"
                           placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-vela-azul w-100 py-3 fw-bold mb-3">
                    Entrar
                </button>
            </form>

            <p class="text-center mt-4 mb-0" style="color: var(--gray);">
                Não tem uma conta?
                <a href="cadastro.php" class="fw-bold text-decoration-none" style="color: var(--azul);">
                    Cadastre-se
                </a>
            </p>

        </div>
    </div>

</div>

</body>
</html>
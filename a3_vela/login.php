<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
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
        header('Location: index.php');
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
</head>
<body class="bg-login d-flex align-items-center justify-content-center min-vh-100">

    <div class="card shadow-lg" style="width: 420px;">

        <div class="card-header text-center py-4">
            <h4 class="mb-0 fw-bold text-white">⛵ Vela Para Todos</h4>
            <small class="text-white opacity-75">Federação Brasileira de Vela Adaptada</small>
        </div>

        <div class="card-body p-4">
            <h5 class="mb-4 text-center" style="color: #19629E;">Acesse sua conta</h5>

            <?php if ($erro): ?>
                <div class="alert alert-danger py-2"><?php echo $erro ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label fw-semibold">E-mail</label>
                    <input type="email" name="usuario" class="form-control" placeholder="seu@email.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Senha</label>
                    <input type="password" name="senha" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Entrar</button>
            </form>
        </div>

        <div class="card-footer text-center py-3">
            <small style="color: #4A4A4A;">Não tem conta? <a href="cadastro.php" style="color: #1D71B8;">Cadastre-se</a></small>
        </div>

    </div>

</body>
</html>
<?php
session_start();

include 'conexao.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha   = md5($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha',   $senha);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $_SESSION['usuario_id'] = $user->id;
        $_SESSION['usuario']    = $user->usuario;
        header('Location: index.php');
        exit;
    } else {
        $erro = 'Usuário ou senha incorretos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh">
        <div class="card p-4 shadow" style="width: 350px">
            <h4 class="mb-3 text-center">Login</h4>

            <?php if ($erro): ?>
                <div class="alert alert-danger"><?php echo $erro ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Usuário:</label>
                    <input type="text" name="usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha:</label>
                    <input type="password" name="senha" class="form-control" required>
                </div>
                <input type="submit" value="Entrar" class="btn btn-primary w-100">
            </form>
        </div>
    </div>
</body>
</html>
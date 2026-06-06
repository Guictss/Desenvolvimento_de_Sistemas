<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

include 'conexao.php';

$erro  = '';
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome            = trim($_POST['nome']);
    $email           = trim($_POST['email']);
    $data_nascimento = $_POST['data_nascimento'];
    $papel           = $_POST['papel'];
    $senha           = $_POST['senha'];
    $confirma        = $_POST['confirma'];

    if (empty($nome) || empty($email) || empty($data_nascimento) || empty($senha)) {
        $erro = 'Preencha todos os campos obrigatórios.';

    } elseif ($senha !== $confirma) {
        $erro = 'As senhas não coincidem.';

    } elseif (strlen($senha) < 6) {
        $erro = 'A senha deve ter no mínimo 6 caracteres.';

    } else {
        // Verifica se o e-mail já está cadastrado
        $sqlCheck = "SELECT id FROM usuarios WHERE email = :email";
        $stmtCheck = $conexao->prepare($sqlCheck);
        $stmtCheck->bindParam(':email', $email);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            $erro = 'Este e-mail já está cadastrado.';
        } else {
            $senhaMd5 = md5($senha);
            $sql  = "INSERT INTO usuarios (nome, email, senha, data_nascimento, papel)
                     VALUES (:nome, :email, :senha, :data_nascimento, :papel)";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':nome',            $nome);
            $stmt->bindParam(':email',           $email);
            $stmt->bindParam(':senha',           $senhaMd5);
            $stmt->bindParam(':data_nascimento', $data_nascimento);
            $stmt->bindParam(':papel',           $papel);
            $stmt->execute();
            $sucesso = 'Cadastro realizado com sucesso!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro · Vela Para Todos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-login d-flex align-items-center justify-content-center min-vh-100 py-5">

    <div class="card shadow-lg" style="width: 480px;">

        <div class="card-header text-center py-4">
            <h4 class="mb-0 fw-bold text-white">⛵ Vela Para Todos</h4>
            <small class="text-white opacity-75">Criar nova conta</small>
        </div>

        <div class="card-body p-4">

            <?php if ($erro): ?>
                <div class="alert alert-danger py-2"><?php echo $erro ?></div>
            <?php endif; ?>

            <?php if ($sucesso): ?>
                <div class="alert alert-success py-2">
                    <?php echo $sucesso ?>
                    <a href="login.php" class="alert-link">Clique aqui para entrar.</a>
                </div>
            <?php endif; ?>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nome completo *</label>
                    <input type="text" name="nome" class="form-control"
                           placeholder="Seu nome completo" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">E-mail *</label>
                    <input type="email" name="email" class="form-control"
                           placeholder="seu@email.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Data de nascimento *</label>
                    <input type="date" name="data_nascimento" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Perfil *</label>
                    <select name="papel" class="form-select" required>
                        <option value="aluno">Aluno</option>
                        <option value="professor">Professor</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Senha *</label>
                    <input type="password" name="senha" class="form-control"
                           placeholder="Mínimo 6 caracteres" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Confirmar senha *</label>
                    <input type="password" name="confirma" class="form-control"
                           placeholder="Repita a senha" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Cadastrar</button>

            </form>

        </div>

        <div class="card-footer text-center py-3">
            <small style="color: #4A4A4A;">
                Já tem conta? <a href="login.php" style="color: #1D71B8;">Faça login</a>
            </small>
        </div>

    </div>

</body>
</html>
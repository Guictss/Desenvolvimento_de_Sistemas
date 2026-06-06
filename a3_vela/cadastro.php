<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header('Location: painel.php');
    exit;
}

include 'conexao.php';

$erro    = '';
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
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>

<div class="auth-container">

    <!-- ── Coluna visual ──────────────────────────────────────────────── -->
    <div class="auth-visual">
        <div class="auth-pattern"></div>
        <div class="auth-content">
            <img src="assets/img/logo-vertical.png" alt="Vela Para Todos" class="auth-logo">
            <img src="assets/img/mascote.png" alt="Zoé" class="auth-mascote">
            <h3 class="fw-bold mb-2 text-white">Junte-se a nós!</h3>
            <p class="text-white opacity-75 px-4">
                Cadastre-se e faça parte da maior iniciativa de vela adaptada do Brasil.
            </p>
        </div>
    </div>

    <!-- ── Coluna do formulário ───────────────────────────────────────── -->
    <div class="auth-form">
        <div class="auth-form-inner">

            <a href="index.php" class="text-decoration-none mb-4 d-inline-block" style="color: var(--gray);">
                ← Voltar ao início
            </a>

            <h2 class="fw-bold mb-2" style="color: var(--azul-dark);">Criar conta</h2>
            <p class="text-muted mb-4">Preencha os dados para se cadastrar</p>

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
                    <input type="text" name="nome" class="form-control" required>
                </div>

                <div class="row g-3">
                    <div class="col-md-7">
                        <label class="form-label fw-semibold">E-mail *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-semibold">Data nasc. *</label>
                        <input type="date" name="data_nascimento" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3 mt-3">
                    <label class="form-label fw-semibold">Perfil *</label>
                    <select name="papel" class="form-select" required>
                        <option value="aluno">Aluno</option>
                        <option value="professor">Professor</option>
                    </select>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Senha *</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Confirmar *</label>
                        <input type="password" name="confirma" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-vela-azul w-100 py-3 fw-bold mt-4">
                    Cadastrar
                </button>

            </form>

            <p class="text-center mt-4 mb-0" style="color: var(--gray);">
                Já tem conta?
                <a href="login.php" class="fw-bold text-decoration-none" style="color: var(--azul);">
                    Faça login
                </a>
            </p>

        </div>
    </div>

</div>

</body>
</html>
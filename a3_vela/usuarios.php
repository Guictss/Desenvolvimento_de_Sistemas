<?php
include 'sessao.php';
include 'conexao.php';

// Apenas professores acessam
if ($_SESSION['papel'] !== 'professor') {
    header('Location: index.php');
    exit;
}

$titulo = 'Usuários';
$papel  = isset($_GET['papel']) && $_GET['papel'] !== '' ? $_GET['papel'] : null;

$sql = "SELECT * FROM usuarios WHERE 1=1";
if ($papel) $sql .= " AND papel = :papel";
$sql .= " ORDER BY nome ASC";

$stmt = $conexao->prepare($sql);
if ($papel) $stmt->bindParam(':papel', $papel);
$stmt->execute();

include 'includes/layout.php';
?>

    <h4 class="fw-bold mb-4" style="color: var(--azul-dark);">👥 Usuários do Sistema</h4>

    <!-- Filtro -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body py-3">
            <form method="get" class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">🎯 Filtrar por perfil</label>
                    <select name="papel" class="form-select">
                        <option value="">Todos os perfis</option>
                        <option value="aluno"     <?php echo $papel === 'aluno'     ? 'selected' : '' ?>>Apenas Alunos</option>
                        <option value="professor" <?php echo $papel === 'professor' ? 'selected' : '' ?>>Apenas Professores</option>
                    </select>
                </div>
                <div class="col-md-6 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">🔍 Filtrar</button>
                    <a href="usuarios.php" class="btn btn-outline-secondary">Limpar</a>
                </div>
            </form>
        </div>
    </div>

    <?php if ($stmt->rowCount() === 0): ?>
        <div class="alert alert-info">Nenhum usuário encontrado.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead style="background-color: var(--azul-med); color: white;">
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Data de Nascimento</th>
                        <th>Perfil</th>
                        <th>Cadastrado em</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($u = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td><?php echo $u->nome ?></td>
                        <td><?php echo $u->email ?></td>
                        <td><?php echo date('d/m/Y', strtotime($u->data_nascimento)) ?></td>
                        <td>
                            <span class="badge <?php echo $u->papel === 'professor' ? 'badge-professor' : 'badge-aluno' ?>">
                                <?php echo ucfirst($u->papel) ?>
                            </span>
                        </td>
                        <td><?php echo date('d/m/Y', strtotime($u->criado_em)) ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>
</body>
</html>
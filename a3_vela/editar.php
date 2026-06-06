<?php
include 'sessao.php';
include 'conexao.php';

if ($_SESSION['papel'] !== 'professor') {
    header('Location: painel.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: painel.php');
    exit;
}

$id   = $_GET['id'];
$erro = '';

// Busca a aula
$sql  = "SELECT * FROM aulas WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$aula = $stmt->fetch(PDO::FETCH_OBJ);

if (!$aula) {
    header('Location: painel.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data        = $_POST['data'];
    $horario     = $_POST['horario'];
    $duracao_min = $_POST['duracao_min'];
    $vagas       = $_POST['vagas'];
    $descricao   = $_POST['descricao'];

    if (empty($data) || empty($horario) || empty($duracao_min) || empty($vagas)) {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {
        $sql  = "UPDATE aulas 
                 SET data = :data, horario = :horario, duracao_min = :duracao_min,
                     vagas = :vagas, descricao = :descricao
                 WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':data',        $data);
        $stmt->bindParam(':horario',     $horario);
        $stmt->bindParam(':duracao_min', $duracao_min);
        $stmt->bindParam(':vagas',       $vagas);
        $stmt->bindParam(':descricao',   $descricao);
        $stmt->bindParam(':id',          $id);
        $stmt->execute();
        header('Location: painel.php');
        exit;
    }
}

$titulo = 'Editar Aula';
include 'includes/layout.php';
?>

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm">
                <div class="card-header py-3" style="background-color: var(--amarelo-d);">
                    <h5 class="mb-0 fw-bold" style="color: var(--dark);">✏️ Editar Aula</h5>
                </div>

                <div class="card-body p-4">

                    <?php if ($erro): ?>
                        <div class="alert alert-danger"><?php echo $erro ?></div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Data *</label>
                                <input type="date" name="data" class="form-control"
                                       value="<?php echo $aula->data ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Horário *</label>
                                <input type="time" name="horario" class="form-control"
                                       value="<?php echo substr($aula->horario, 0, 5) ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Duração (minutos) *</label>
                                <input type="number" name="duracao_min" class="form-control"
                                       value="<?php echo $aula->duracao_min ?>" min="15" max="480" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Vagas *</label>
                                <input type="number" name="vagas" class="form-control"
                                       value="<?php echo $aula->vagas ?>" min="1" max="50" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Descrição</label>
                                <textarea name="descricao" class="form-control" rows="3"><?php echo $aula->descricao ?></textarea>
                            </div>

                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-warning px-4 fw-bold">Salvar Alterações</button>
                            <a href="painel.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
</body>
</html>
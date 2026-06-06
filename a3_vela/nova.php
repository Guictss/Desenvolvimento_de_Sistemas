<?php
include 'sessao.php';
include 'conexao.php';

// Apenas professores podem cadastrar aulas
if ($_SESSION['papel'] !== 'professor') {
    header('Location: painel.php');
    exit;
}

$titulo = 'Nova Aula';
$erro   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $professor_id = $_SESSION['usuario_id'];
    $data         = $_POST['data'];
    $horario      = $_POST['horario'];
    $duracao_min  = $_POST['duracao_min'];
    $vagas        = $_POST['vagas'];
    $descricao    = $_POST['descricao'];

    if (empty($data) || empty($horario) || empty($duracao_min) || empty($vagas)) {
        $erro = 'Preencha todos os campos obrigatórios.';
    } else {
        $sql  = "INSERT INTO aulas (professor_id, data, horario, duracao_min, vagas, descricao)
                 VALUES (:professor_id, :data, :horario, :duracao_min, :vagas, :descricao)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':professor_id', $professor_id);
        $stmt->bindParam(':data',         $data);
        $stmt->bindParam(':horario',      $horario);
        $stmt->bindParam(':duracao_min',  $duracao_min);
        $stmt->bindParam(':vagas',        $vagas);
        $stmt->bindParam(':descricao',    $descricao);
        $stmt->execute();
        header('Location: painel.php');
        exit;
    }
}

include 'includes/layout.php';
?>

    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow-sm">
                <div class="card-header py-3" style="background-color: var(--azul-med);">
                    <h5 class="mb-0 text-white fw-bold">+ Nova Aula</h5>
                </div>

                <div class="card-body p-4">

                    <?php if ($erro): ?>
                        <div class="alert alert-danger"><?php echo $erro ?></div>
                    <?php endif; ?>

                    <form method="post">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Data *</label>
                                <input type="date" name="data" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Horário *</label>
                                <input type="time" name="horario" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Duração (minutos) *</label>
                                <input type="number" name="duracao_min" class="form-control" 
                                       min="15" max="480" placeholder="Ex: 60" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Vagas *</label>
                                <input type="number" name="vagas" class="form-control" 
                                       min="1" max="50" placeholder="Ex: 10" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold">Descrição</label>
                                <textarea name="descricao" class="form-control" rows="3"
                                          placeholder="Observações sobre a aula (opcional)"></textarea>
                            </div>

                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary px-4">Salvar Aula</button>
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
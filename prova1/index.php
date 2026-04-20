<?php 

include 'conexao.php'; 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Notas</title>
</head>
<body>
    <h1>Formulário de Notas</h1>
    <form action="index.php" method="post">
        <label>Nome: </label>
        <input type="text" name="txtNome" id="txtNome">
        <br>
        <label>Nota 1: </label>
        <input type="number" name="numNota1" id="numNota1">
        <br>
        <label>Nota 2: </label>
        <input type="number" name="numNota2" id="numNota2">
        <br>
        <label>Nota 3: </label>
        <input type="number" name="numNota3" id="numNota3">
        <br>
        <input type="submit" value="Entrar">
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nome  = $_POST['txtNome'];
        $nota1 = $_POST['numNota1'];
        $nota2 = $_POST['numNota2'];
        $nota3 = $_POST['numNota3'];

        $mediaAluno = ($nota1 + $nota2 + $nota3) / 3;

        $sql = "INSERT INTO turma (nome, nota1, nota2, nota3, media) VALUES (:nome, :nota1, :nota2, :nota3, :media)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome',  $nome);
        $stmt->bindParam(':nota1', $nota1);
        $stmt->bindParam(':nota2', $nota2);
        $stmt->bindParam(':nota3', $nota3);
        $stmt->bindParam(':media', $mediaAluno);
        $stmt->execute();

        echo "<p><strong>Situação de $nome:</strong> ";
        if ($mediaAluno >= 7) {
            echo "Aprovado! Parabéns!!";
        } elseif ($mediaAluno >= 5) {
            echo "Recuperação...";
        } else {
            echo "Reprovado! Sinto Muito.";
        }
        echo "</p>";
    } ?>

    <?php
        $consulta = $conexao->query("SELECT * FROM turma");
    ?>

    <table width="100%" border="1">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Nota 1</th>
                <th>Nota 2</th>
                <th>Nota 3</th>
                <th>Média</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) { ?>
            <tr>
                <td><?php echo $linha->id ?></td>
                <td><?php echo $linha->nome ?></td>
                <td><?php echo $linha->nota1 ?></td>
                <td><?php echo $linha->nota2 ?></td>
                <td><?php echo $linha->nota3 ?></td>
                <td><?php echo number_format($linha->media, 2) ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</body>
</html>
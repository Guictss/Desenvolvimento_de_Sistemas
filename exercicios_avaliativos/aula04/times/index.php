<?php

    include '../sessao.php';
    include '../conexao.php';
    
    $sql = " SELECT * FROM times ";
    $consulta = $conexao->query($sql);

    # Edição
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM times WHERE id = :id";
        $consultaUp = $conexao->prepare($sql);
        $consultaUp->bindParam(':id', $id);
        $consultaUp->execute();
        $time = $consultaUp->fetch(PDO::FETCH_OBJ);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Times</title>
</head>
<body>

    <form action="inserir.php" method="get">
        <input type="hidden" name="id" value="<?php echo isset($time) ? $time->id : '' ?>">
        Nome: <input value="<?php echo isset($time) ? $time->nome : '' ?>" type="text" name="txtNome" required>
        Estado: <input value="<?php echo isset($time) ? $time->estado : '' ?>" type="text" name="txtEstado">
        Fundação: <input value="<?php echo isset($time) ? $time->fundacao : '' ?>" type="number" name="numFundacao">
        <input type="submit" value="Salvar">
    </form>
    <br><br>

    <table width="100%" border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Estado</th>
            <th>Fundação</th>
            <th colspan="2">Ações</th>
        </tr>
    
        <?php
            while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
        ?>
            <tr>
                <td><?php echo $linha->id ?></td>
                <td><?php echo $linha->nome ?></td>
                <td><?php echo $linha->estado ?></td>
                <td><?php echo $linha->fundacao ?></td>
                <td>
                    <a href="index.php?id=<?php echo $linha->id ?>">Editar</a> | 
                    <a href="excluir.php?id=<?php echo $linha->id ?>">Excluir</a>
                </td>
            </tr>
        <?php 
            } 
        ?>
    </table>

</body>
</html>
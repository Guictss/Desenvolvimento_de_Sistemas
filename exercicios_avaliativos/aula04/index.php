<?php

include 'conexao.php';

// Lista todos os alunos
// comando de seleção
$sql = "SELECT * FROM times";
// execução do comando select
$consulta = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Times de Futebol</title>
</head>
<body>
    <table width="100%" border="1">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nome</th>
			<th>Estado</th>
			<th>Ano de Fundação</th>
            <th>Ações</th>
		</tr>
	</thead>
    <tbody>
	<?php
		while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
	?>
		<tr>
			<td><?php  echo $linha->id ?></td>
			<td><?php  echo $linha->nome ?></td>
			<td><?php  echo $linha->estado ?></td>
            <td><?php  echo $linha->fundacao ?></td>
			<td>
				<a href="index.php?id=<?php echo $linha->id ?>">Editar</a>
				<a href="excluir.php?id=<?php echo $linha->id ?>">Excluir</a>
			</td>
		</tr>
	<?php
		}
	?>
    </tbody>
</table>
</body>
</html>
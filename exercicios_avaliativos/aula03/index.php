<?php

include 'conexao.php';

// Lista todos os alunos
// comando de seleção
$sql = "SELECT * FROM selecao";
// execução do comando select
$consulta = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Times</title>
</head>
<body>
    <table width="100%" border="1">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nome</th>
			<th>Quantidade de Títulos</th>
		</tr>
	</thead>
    <tbody>
	<?php
		while ($linha = $consulta->fetch(PDO::FETCH_OBJ)) {
	?>
		<tr>
			<td><?php  echo $linha->id ?></td>
			<td><?php  echo $linha->nome ?></td>
			<td><?php  echo $linha->qtd_titulo ?></td>
		</tr>
	<?php
		}
	?>
    </tbody>
</table>
</body>
</html>
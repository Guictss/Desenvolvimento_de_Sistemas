<?php
echo "<h2>Desafios Extras: Mestre Jedi (Misturando Estruturas)</h2>";

// 1. Números pares de 1 a 50
echo "Avaliando ID de Clones no esquadrão par:<br>";
for ($i = 1; $i <= 50; $i++) {
    if ($i % 2 == 0) {
        echo "CT-$i | ";
    }
}
echo "<br><br>";

// 2. Contar vogais em uma palavra
$mensagem = "Ajude-me Obi-Wan Kenobi, voce é minha única esperança";
$vogaisEncontradas = 0;
$mensagemMinuscula = strtolower($mensagem);

for ($i = 0; $i < strlen($mensagemMinuscula); $i++) {
    $letra = $mensagemMinuscula[$i];
    if (in_array($letra, ['a', 'e', 'i', 'o', 'u'])) {
        $vogaisEncontradas++;
    }
}
echo "Mensagem interceptada: '$mensagem'<br>";
echo "A matriz do R3-D4 encontrou $vogaisEncontradas vogais no código.<br><br>";

// 3. Maior número de um array
$recompensas = [5000, 12000, 8500, 25000, 100];
$maiorRecompensa = 0;

foreach ($recompensas as $valor) {
    if ($valor > $maiorRecompensa) {
        $maiorRecompensa = $valor;
    }
}
echo "Boba Fett encontrou o alvo mais valioso! Recompensa máxima: $maiorRecompensa Créditos da República.<br><br>";

// 4. Simular caixa eletrônico
$saldoStuds = 150000;
$precoNave = 200000;
echo "Saldo no banco do Jabba: $saldoStuds Studs.<br>";
echo "Tentando comprar a Slave I por $precoNave Studs...<br>";

if ($saldoStuds >= $precoNave) {
    $saldoStuds -= $precoNave;
    echo "Compra aprovada! Nave desbloqueada. Novo saldo: $saldoStuds Studs.<br>";
} else {
    echo "Saldo insuficiente! Destrua mais objetos do cenário para farmar peças de LEGO.<br>";
}
?>
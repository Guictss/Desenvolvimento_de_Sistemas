<?php
echo "<h2>Nível 3: Modo História (Repetição FOR)</h2>";

// 1. Contagem de 1 a 10
echo "Coletando Minikits: ";
for ($i = 1; $i <= 10; $i++) {
    echo "[$i/10] ";
}
echo "<br><br>";

// 2. Contagem regressiva
echo "Preparando salto para o hiperespaço: ";
for ($i = 10; $i >= 1; $i--) {
    echo "$i... ";
}
echo "CHEWWIEEEEE! (Salto realizado)<br><br>";

// 3. Tabuada
$codigoAcesso = 7;
echo "Painel de acesso Imperial. Tabuada de segurança do número $codigoAcesso:<br>";
for ($i = 1; $i <= 10; $i++) {
    echo "$codigoAcesso x $i = " . ($codigoAcesso * $i) . "<br>";
}
echo "<br>";

// 4. Soma dos números de 1 a 100
$totalStuds = 0;
for ($i = 1; $i <= 100; $i++) {
    $totalStuds += $i;
}
echo "Você atingiu o nível Jedi Verdadeiro! Total de peças somadas: $totalStuds.<br>";
?>
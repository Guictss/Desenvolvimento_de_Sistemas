<?php
echo "<h2>Nível 2: O Caminho da Força (Condicionais if)</h2>";

// 1. Verificar maioridade
$idadePiloto = 16;
if ($idadePiloto >= 18) {
    echo "Piloto autorizado. Que a Força esteja com você!<br>";
} else {
    echo "Muito jovem você é. Menor de idade para pilotar a X-Wing.<br>";
}
echo "<br>";

// 2. Número positivo, negativo ou zero
$pontosDeForca = -50;
if ($pontosDeForca > 0) {
    echo "Alinhamento: Lado Luminoso (Positivo).<br>";
} elseif ($pontosDeForca < 0) {
    echo "Alinhamento: Lado Sombrio (Negativo). Cuidado com os Sith!<br>";
} else {
    echo "Alinhamento: Droid / Neutro (Zero).<br>";
}
echo "<br>";

// 3. Verificar número par ou ímpar
$cristaisKyber = 7;
if ($cristaisKyber % 2 == 0) {
    echo "Você tem um número PAR de cristais Kyber ($cristaisKyber).<br>";
} else {
    echo "Você tem um número ÍMPAR de cristais Kyber ($cristaisKyber).<br>";
}
echo "<br>";

// 4. Calculadora simples
$valor1 = 100;
$valor2 = 25;
$operacao = "/";

echo "R2-D2 calculando $valor1 $operacao $valor2... Bip Bop! Resultado: ";
if ($operacao == "+") {
    echo $valor1 + $valor2;
} elseif ($operacao == "-") {
    echo $valor1 - $valor2;
} elseif ($operacao == "*") {
    echo $valor1 * $valor2;
} elseif ($operacao == "/") {
    echo $valor1 / $valor2;
}
echo "<br>";
?>
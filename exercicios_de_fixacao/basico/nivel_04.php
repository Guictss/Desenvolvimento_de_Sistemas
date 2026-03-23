<?php
echo "<h2>Nível 4: Sobrevivência (Repetição WHILE)</h2>";

// 1. Contagem até 10
$stormtroopersDerrotados = 1;
echo "Iniciando combate na Estrela da Morte:<br>";
while ($stormtroopersDerrotados <= 10) {
    echo "Stormtrooper $stormtroopersDerrotados derrotado com sabre de luz!<br>";
    $stormtroopersDerrotados++;
}
echo "<br>";

// 2. Somar números até atingir 100
$somaBarrinha = 0;
$contadorPecas = 1;
while ($somaBarrinha <= 100) {
    $somaBarrinha += $contadorPecas;
    $contadorPecas++;
}
echo "A barra de Jedi Verdadeiro encheu! Soma final: $somaBarrinha (Pecinhas coletadas: " . ($contadorPecas - 1) . ").<br><br>";

// 3. Validação simples
$senhaTerminal = "Pork";
$senhaDigitada = "R2D2"; 
$tentativas = 1;

echo "Terminal bloqueado. Tentando hackear...<br>";
while ($senhaDigitada != $senhaTerminal && $tentativas < 3) {
    echo "Tentativa $tentativas: Senha Incorreta.<br>";
    $senhaDigitada = "Pork";
    $tentativas++;
}
if ($senhaDigitada == $senhaTerminal) {
    echo "Acesso concedido. Porta destrancada!<br>";
}
?>
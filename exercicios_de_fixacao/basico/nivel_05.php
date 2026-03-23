<?php
echo "<h2>Nível 5: O Conselho Jedi (DO...WHILE)</h2>";

// 1. Executar pelo menos uma vez
$entrouNaCantina = false;
do {
    echo "Você entrou na Cantina. A banda dos Bith está tocando aquela música clássica!<br>";    
} while ($entrouNaCantina);
echo "<br>";

// 2. Menu simples
$escolha = 1;
$rodadasMenu = 0;

echo "Acessando o Holocron...<br>";
do {
    if ($escolha == 1) {
        echo "Opção 1: Lendo arquivos Sith perdidos...<br>";
        $escolha = 2;
    }
    $rodadasMenu++;
} while ($escolha != 2);
echo "Opção 2: Desligando Holocron. Que a Força esteja com você.<br>";
?>
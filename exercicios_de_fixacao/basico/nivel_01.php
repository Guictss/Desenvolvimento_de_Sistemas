<?php
echo "<h2>Nível 1: Treinamento Padawan (Variáveis e Operações)</h2>";

// 1. Variáveis básicas do Personagem LEGO
$nomePersonagem = "Luke Skywalker";
$idadeLego = 19;
$alturaPecas = 4;

echo "Personagem: $nomePersonagem | Idade: $idadeLego | Altura: $alturaPecas pecinhas de LEGO.<br><br>";

// 2. Soma de dois Studs)
$studsPrata = 150;
$studsOuro = 300;

echo "Studs de Prata: $studsPrata | Studs de Ouro: $studsOuro <br>";
echo "Soma total: " . ($studsPrata + $studsOuro) . "<br>";
echo "Diferença: " . ($studsOuro - $studsPrata) . "<br>";
echo "Multiplicação: " . ($studsPrata * $studsOuro) . "<br>";
echo "Divisão: " . ($studsOuro / $studsPrata) . "<br><br>";

// 3. Conversão de temperatura em Tatooine
$tempCelsiusTatooine = 45;
$tempFahrenheitTatooine = ($tempCelsiusTatooine * 1.8) + 32;

echo "Temperatura nos desertos de Tatooine: {$tempCelsiusTatooine}°C, que equivale a {$tempFahrenheitTatooine}°F.<br><br>";

// 4. Concatenação de strings Jedi
$titulo = "Mestre Jedi";
$nome = "Obi-Wan";
$nomeCompleto = $titulo . " " . $nome;

echo "O conselho saúda o: " . $nomeCompleto . "!<br>";
?>
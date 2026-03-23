<?php
echo "<h2>Nível 6: O Esquadrão (FOREACH com Arrays)</h2>";

// 1. Lista de nomes
$personagensLego = ["Luke", "Obi-Wan", "Maul", "Chewbacca", "Tauntaun"];
echo "Seu esquadrão no modo Jogo Livre:<br>";
foreach ($personagensLego as $personagem) {
    echo "- Personagem desbloqueado: $personagem <br>";
}
echo "<br>";

// 2. Somar valores de um array
$precosTijolos = [1000, 2000, 5000, 10000, 50000];
$custoTotal = 0;
foreach ($precosTijolos as $preco) {
    $custoTotal += $preco;
}
echo "Custo total para comprar todos os multiplicadores de peças: $custoTotal studs.<br><br>";

// 3. Exibir produtos e preços
$lojaCantina = [
    "Rum Corelliano" => 50,
    "Leite Azul" => 20,
    "Lanche de Wookiee" => 35
];
echo "Cardápio da Cantina:<br>";
foreach ($lojaCantina as $produto => $preco) {
    echo "Item: $produto - Preço: $preco Studs Prata<br>";
}
echo "<br>";

// 4. Verificar aprovação de alunos
$padawans = [
    "Ahsoka Tano" => 9,
    "Darth Vader" => 6,
    "Qui-Gon Jinn" => 8,
    "Grogu" => 5
];
echo "Resultados do Treinamento Padawan:<br>";
foreach ($padawans as $nome => $nota) {
    if ($nota >= 7) {
        echo "$nome: APROVADO(A) pelo Conselho Jedi.<br>";
    } else {
        echo "$nome: REPROVADO(A). Precisa treinar mais com o sabre de luz.<br>";
    }
}
?>
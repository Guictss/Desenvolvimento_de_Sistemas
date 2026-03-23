<?php

    $host = "127.0.0.1";
    $user = "root";
    $porta = "3306";
    $password = "ReapperOW31.";
    $db = "futebol";


    $conexao = new PDO(
        'mysql:host='.$host.';
        port='.$porta.';
        dbname='.$db,
        $user,
        $password);
        
?>
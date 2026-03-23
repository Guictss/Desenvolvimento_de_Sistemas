<?php

    $host = "127.0.0.1";
    $user = "root";
    $porta = "3306";
    $password = "ceub12346";
    $db = "projeto";


    $conexao = new PDO(
        'mysql:host='.$host.';
        port='.$porta.';
        dbname='.$db,
        $user,
        $password);
        
?>
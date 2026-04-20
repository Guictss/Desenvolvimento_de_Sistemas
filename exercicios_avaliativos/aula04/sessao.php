<?php

    session_start();
    if(empty($_SESSION) || $_SESSION['logado'] == false) {
        header('Location:../index.php');
        exit;
    } else {
        echo "Bem vindo, " . $_SESSION['email'];
        echo "<br><a href='../logout.php'>Sair</a>";
    }

?>
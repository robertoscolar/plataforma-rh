<?php
    header("Content-Type: text/html; charset=utf-8");

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "plataforma_rh";

    $link = mysqli_connect($host, $user, $pass, $db);
    $connectionError = mysqli_connect_errno();

    if ($connectionError == true) {
        echo "Erro na conexão";
    
    } else {
        echo "Conexão OK";
    }
?>
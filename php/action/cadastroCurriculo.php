<?php

    header("Content-Type: text/html; charset=utf-8");

    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $assunto = isset($_POST['assunto']) ? $_POST['assunto'] : '';
    $conteudo = isset($_POST['conteudo']) ? $_POST['conteudo'] : '';

    $sql = "INSERT INTO contato (nome, email, assunto, conteudo) VALUES ('$nome', '$email', '$assunto', '$conteudo')";
    echo $sql;

    include_once("connect.php");

    $resultado = mysqli_query($link, $sql);
    var_dump($resultado);

    if ($resultado == true) {
        echo "<script> alert('Contato inserido com sucesso!!'); </script>";

    } else {
        echo "<script> alert('Falha na inserção do contato! '); </script>";
    }
?>
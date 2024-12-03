<?php

function validaRequisicao($conn, $tabela, $coluna1, $valor1, $coluna2, $valor2)
{

    $count = 0;

    $stmt = $conn->prepare(
        "
    SELECT COUNT(1) FROM $tabela
        WHERE $coluna1 = ?
          AND $coluna2 = ?"
    );

    $stmt->bind_param(
        "ss",
        $valor1,
        $valor2
    );

    $stmt->execute();

    $stmt->store_result();

    $stmt->bind_result($count);
    $stmt->fetch();

    return $count;
}
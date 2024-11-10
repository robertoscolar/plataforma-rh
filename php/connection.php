<?php
header("Content-Type: text/html; charset=utf-8");

error_reporting(0);
ini_set('display_errors', 0);

$host = "localhost";
$user = "root";
$pass = "";
$db = "construtech";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "Falha na conexão com o banco de dados. Por favor, tente novamente mais tarde.";
    exit();
}
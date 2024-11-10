<?php
header("Content-Type: text/html; charset=utf-8");

$host = "localhost";
$user = "root";
$pass = "";
$db = "construtech";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
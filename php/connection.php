<?php

require 'environmentLoader.php';
loadEnv(__DIR__ . '/../.env');

header("Content-Type: text/html; charset=utf-8");

error_reporting(0);
ini_set('display_errors', 0);

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "Falha na conexão com o banco de dados. Por favor, tente novamente em alguns minutos.";
    exit();
}
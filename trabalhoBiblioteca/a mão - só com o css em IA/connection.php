<?php

$server = "localhost: 3306";
$user = "root";
$password = "batata";
$database = "biblioteca";
$port = 3306;

$conn = new mysqli($server, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados" . $conn->connect_error);
}
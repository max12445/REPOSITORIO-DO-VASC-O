<?php

$server = "localhost";
$user = "root";
$password = "root";
$database = "cadastro";
$port = 3307;

$conn = new mysqli($server, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados" . $conn->connect_error);
} else {
    echo 'conectado com sucesso';
}

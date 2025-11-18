<?php
require "connection.php";

if ($_POST) {
    $usuario  = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO usuario (usuario, email, password)
            VALUES ('$nome', '$email', '$senha')";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        $erro = "Erro ao cadastrar!";
    }
}
?>
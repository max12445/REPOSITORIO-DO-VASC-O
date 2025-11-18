<?php 
include("connection.php");
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$password = $_POST['password'];


$sql = "INSERT INTO usuario (usuario, email, password) VALUES ('$usuario', '$email', '$password')";

if($conn->query($sql) === TRUE){
    echo "Usuário cadastrado com sucesso!";
}
else{
    echo "Erro: " . $sql . "<br>" . $conn->error;
}


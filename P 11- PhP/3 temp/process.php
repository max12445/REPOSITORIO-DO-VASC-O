<?php 
include("connection.php");

$email = $_POST['email'];
$password = $_POST['password'];
$confirmar = $_POST['confirmar'];

$sql = "INSERT INTO usuario (email, password) VALUES ('$email', '$password')";

if($conn->query($sql) === TRUE){
    echo "Usuário cadastrado com sucesso!";
}
else{
    echo "Erro: " . $sql . "<br>" . $conn->error;
}


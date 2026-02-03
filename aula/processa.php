<?php 

include_once 'cod.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];
$nasc = $_POST['nasc'];

$senha_criptografada = md5($senha);


$sql = "INSERT INTO usuario(nome, email, senha, cpf, nasc) VALUES ('$nome','$email', '$senha_criptografada', '$cpf', '$nasc')"; 


if(mysqli_query($conn, $sql)){
    return true;
}
else{
    return false;
}

?>


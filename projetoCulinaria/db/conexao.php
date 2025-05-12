<?php
include 'config.php';

$conexao = mysqli_connect(SERVER, USER, PASSWORD, BASE);

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

mysqli_set_charset($conexao, "utf8");
?>

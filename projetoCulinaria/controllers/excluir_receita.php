<?php
include('../db/conexao.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $query = "DELETE FROM receitas WHERE id = $id";
    $resultado = mysqli_query($conexao, $query);

    if ($resultado) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'erro' => 'Erro ao excluir']);
    }
} else {
    echo json_encode(['success' => false, 'erro' => 'ID não fornecido']);
}
?>

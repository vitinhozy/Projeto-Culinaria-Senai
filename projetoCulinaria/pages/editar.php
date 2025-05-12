<?php
include('../db/conexao.php');

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    echo "ID da receita não informado.";
    exit;
}

$id = $_GET['id'];

// Busca os dados da receita
$sql = "SELECT * FROM receitas WHERE id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$receita = mysqli_fetch_assoc($result);

if (!$receita) {
    echo "Receita não encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Receita</title>
    <link rel="stylesheet" href="../style/cadastro.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="../img/logo.png" alt="Logo" class="img-fluid" style="height: 60px;">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="listar_receita.php">RECEITAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_receita.php">CADASTRAR RECEITA</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<form action="../controllers/atualizar_receita.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $receita['id'] ?>">
    <input type="text" name="titulo" value="<?= htmlspecialchars($receita['titulo']) ?>" required>
    <textarea name="descricao" required><?= htmlspecialchars($receita['descricao']) ?></textarea>
    <textarea name="receitaTexto" required><?= htmlspecialchars($receita['receitaTexto']) ?></textarea>
    <input type="text" name="autor" value="<?= htmlspecialchars($receita['autor']) ?>" required>

    <select name="tipo" required>
        <option value="doce" <?= $receita['tipo'] == 'doce' ? 'selected' : '' ?>>Doce</option>
        <option value="salgado" <?= $receita['tipo'] == 'salgado' ? 'selected' : '' ?>>Salgado</option>
        <option value="agridoce" <?= $receita['tipo'] == 'agridoce' ? 'selected' : '' ?>>Agridoce</option>
    </select>

    <input type="file" name="imagem">
    <button type="submit">Atualizar Receita</button>
</form>

</body>
</html>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/cadastro.css">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="Logo" class="img-fluid" style="height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/listar_receita.php">RECEITAS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/cadastro_receita.php">CADASTRAR RECEITA</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <form action="../controllers/cadastrar.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="titulo" placeholder="Título" required>
        <textarea name="descricao" placeholder="Descrição" required></textarea>
        <textarea name="receitaTexto" placeholder="Texto da Receita" required></textarea>
    <input type="text" name="autor" placeholder="Autor" required>
    
    <select name="tipo" required>
        <option value="doce">Doce</option>
        <option value="salgado">Salgado</option>
        <option value="agridoce">Agridoce</option>
    </select>

    <input type="file" name="imagem">
    <button type="submit">Cadastrar Receita</button>
</form>

</body>
</html>
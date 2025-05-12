<?php
include('../db/conexao.php');

// Buscar todas as receitas do banco de dados
$sql = "SELECT * FROM receitas ORDER BY id DESC";
$result = mysqli_query($conexao, $sql);
$receitas = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Receitas Cadastradas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/index.css">
    <style>
        #mensagem-sucesso {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Alerta de sucesso -->
    <div id="mensagem-sucesso" class="alert alert-success text-center m-3" role="alert">
        Receita excluída com sucesso!
    </div>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">
                    <img src="../img/logo.png" alt="Logo" class="img-fluid" style="height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="#">RECEITAS</a></li>
                        <li class="nav-item"><a class="nav-link" href="cadastro_receita.php">CADASTRAR</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-5">
        <h1 class="text-center mb-5">Todas as Receitas Cadastradas</h1>

        <div class="row g-4">
            <?php foreach ($receitas as $receita): ?>
                <div class="col-md-4 col-sm-6 receita-card" id="receita-<?= $receita['id'] ?>">
                    <div class="card h-100">
                        <img src="../assets/imagens/<?= htmlspecialchars($receita['imagem']) ?>" class="card-img-top" alt="<?= htmlspecialchars($receita['titulo']) ?>" style="height: 220px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($receita['titulo']) ?></h5>
                            <p><strong>Tipo:</strong> <?= htmlspecialchars($receita['tipo']) ?></p>
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modal<?= $receita['id'] ?>">Ver Receita</button>

                            <div class="mt-3 d-flex justify-content-center gap-2">
                                <!-- Botão Editar -->
                                <a href="../editar_receita.php?id=<?= $receita['id'] ?>" class="btn btn-primary">Editar</a>

                                <!-- Botão Excluir (apenas na tela) -->
                                <button class="btn btn-primary" onclick="excluirReceita(<?= $receita['id'] ?>)">Excluir</button>
                                    </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal<?= $receita['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $receita['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?= $receita['id'] ?>"><?= htmlspecialchars($receita['titulo']) ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <img src="../assets/imagens/<?= htmlspecialchars($receita['imagem']) ?>" class="img-fluid mb-3 rounded">
                                <p><strong>Descrição:</strong></p>
                                <p><?= htmlspecialchars($receita['descricao']) ?></p>
                                <hr>
                                <p><strong>Modo de Preparo:</strong></p>
                                <p><?= nl2br(htmlspecialchars($receita['receitaTexto'])) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <script>
    function excluirReceita(id) {
        if (confirm('Tem certeza que deseja excluir esta receita?')) {
            fetch('../controllers/excluir_receita.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + encodeURIComponent(id),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove o card visualmente
                    const card = document.getElementById('receita-' + id);
                    if (card) card.remove();

                    // Exibe a mensagem
                    const mensagem = document.getElementById('mensagem-sucesso');
                    mensagem.style.display = 'block';
                    setTimeout(() => {
                        mensagem.style.display = 'none';
                    }, 3000);
                } else {
                    alert('Erro ao excluir a receita: ' + (data.erro || 'Desconhecido'));
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro na requisição');
            });
        }
    }
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

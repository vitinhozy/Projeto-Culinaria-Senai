<?php
    include('db/conexao.php');

    $url = "https://api-receitas-pi.vercel.app/receitas/todas";
    $response = file_get_contents($url);
    $receitas = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitas | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <!-- Navbar -->
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

    <!-- carrousel -->
    <main class="container mt-5">
    <main class="container my-5">
    <div id="carouselExampleFade" class="carousel slide carousel-fade mx-auto mt-4" style="max-width: 900px;">
        <div class="carousel-inner rounded shadow">
        <div class="carousel-item active">
            <img src="img/receita1.jpg" class="d-block w-100" alt="Receita 1" style="height: 400px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="img/receita2.jpg" class="d-block w-100" alt="Receita 2" style="height: 400px; object-fit: cover;">
        </div>
        <div class="carousel-item">
            <img src="img/receita3.jpg" class="d-block w-100" alt="Receita 3" style="height: 400px; object-fit: cover;">
        </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark rounded" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-dark rounded" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>
<section class="container text-center my-5">
    <h2 class="fw-bold">QUAL SUA PRÓXIMA REFEIÇÃO?</h2>
    <p class="text-muted mb-4">Nós temos a ideia perfeita</p>

    <div class="row justify-content-center g-4">
        <div class="col-6 col-sm-4 col-md-3">
            <a href="pages/listar_receita.php?tipo=cafe" class="text-decoration-none text-dark">
                <img src="img/cafe.jpg" class="img-fluid rounded shadow-sm" style="height: 180px; object-fit: cover;">
                <p class="mt-2 fw-semibold">Café da manhã</p>
            </a>
        </div>
        <div class="col-6 col-sm-4 col-md-3">
            <a href="pages/listar_receita.php?tipo=almoco" class="text-decoration-none text-dark">
                <img src="img/almoco.jpg" class="img-fluid rounded shadow-sm" style="height: 180px; object-fit: cover;">
                <p class="mt-2 fw-semibold">Almoço</p>
            </a>
        </div>
        <div class="col-6 col-sm-4 col-md-3">
            <a href="pages/listar_receita.php?tipo=happyhour" class="text-decoration-none text-dark">
                <img src="img/happyhour.jpg" class="img-fluid rounded shadow-sm" style="height: 180px; object-fit: cover;">
                <p class="mt-2 fw-semibold">Happy hour</p>
            </a>
        </div>
        <div class="col-6 col-sm-4 col-md-3">
            <a href="pages/listar_receita.php?tipo=jantar" class="text-decoration-none text-dark">
                <img src="img/jantar.jpg" class="img-fluid rounded shadow-sm" style="height: 180px; object-fit: cover;">
                <p class="mt-2 fw-semibold">Jantar</p>
            </a>
        </div>
    </div>
</section>

<h1 class="text-center my-5">Receitas em Destaque</h1>

<div class="row g-4">
    <?php foreach ($receitas as $index => $receita): ?>
        <?php if ($index == 2): ?>
            </div>
            <div class="collapse" id="verMaisReceitas">
                <div class="row g-4 mt-2">
        <?php endif; ?>

        <div class="col-md-6">
            <div class="card receita-card h-100">
                <img src="<?= htmlspecialchars($receita['link_imagem']) ?>" class="card-img-top receita-img" alt="<?= htmlspecialchars($receita['receita']) ?>" style="height: 220px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($receita['receita']) ?></h5>
                    <p class="card-text"><strong>Tipo:</strong> <?= htmlspecialchars($receita['tipo']) ?></p>
                    <p class="card-text ingredientes"><strong>Ingredientes:</strong> <?= htmlspecialchars($receita['ingredientes']) ?></p>
                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#modal<?= $receita['id'] ?>">Ver Preparo</button>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal<?= $receita['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $receita['id'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= $receita['id'] ?>"><?= htmlspecialchars($receita['receita']) ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <img src="<?= htmlspecialchars($receita['link_imagem']) ?>" class="img-fluid mb-3 rounded">
                        <p><strong>Modo de Preparo:</strong></p>
                        <p><?= nl2br(htmlspecialchars($receita['modo_preparo'])) ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>

<!-- Botão Ver Mais -->
<div class="text-center my-4">
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#verMaisReceitas" aria-expanded="false" aria-controls="verMaisReceitas">
        Ver Mais Receitas
    </button>
</div>

</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

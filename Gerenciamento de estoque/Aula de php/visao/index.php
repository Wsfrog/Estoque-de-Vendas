<?php
require_once '../controle/estoque.php';

$controleEstoqueVideogame = new ControleEstoqueVideogame();
$videogames = $controleEstoqueVideogame->listarVideogames();
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idVideogame']) && isset($_POST['quantidadeVenda'])) {
        $idVideogame = $_POST['idVideogame'];
        $quantidade = $_POST['quantidadeVenda'];
        $controleEstoqueVideogame->adicionarVenda($idVideogame, $quantidade);
        $mensagem = "Venda registrada com sucesso!";
        header("Location: index.php?mensagem=" . urlencode($mensagem));
        exit;
    } elseif (isset($_POST['idVideogameEstoque']) && isset($_POST['quantidadeEstoque'])) {
        $idVideogameEstoque = $_POST['idVideogameEstoque'];
        $quantidadeEstoque = $_POST['quantidadeEstoque'];
        $controleEstoqueVideogame->adicionarAoEstoque($idVideogameEstoque, $quantidadeEstoque);
        $mensagem = "Estoque atualizado com sucesso!";
        header("Location: index.php?mensagem=" . urlencode($mensagem));
        exit;
    }
}

if (isset($_GET['mensagem'])) {
    $mensagem = $_GET['mensagem'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Videogames</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Estoque de Videogames</h1>

        <?php if ($mensagem): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <h2 class="mt-4">Lista de Videogames</h2>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Estoque</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($videogames as $videogame): ?>
                    <tr>
                        <td><?= htmlspecialchars($videogame['idvideogame']) ?></td>
                        <td><?= htmlspecialchars($videogame['nomeVideogame']) ?></td>
                        <td><?= htmlspecialchars($videogame['estoqueVideogame']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="mt-4">Registrar Venda</h2>
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label for="idVideogame" class="form-label">ID do Videogame:</label>
                <input type="number" id="idVideogame" name="idVideogame" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quantidadeVenda" class="form-label">Quantidade:</label>
                <input type="number" id="quantidadeVenda" name="quantidadeVenda" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Venda</button>
        </form>

        <h2 class="mt-4">Atualizar Estoque</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="idVideogameEstoque" class="form-label">ID do Videogame:</label>
                <input type="number" id="idVideogameEstoque" name="idVideogameEstoque" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quantidadeEstoque" class="form-label">Quantidade a Adicionar:</label>
                <input type="number" id="quantidadeEstoque" name="quantidadeEstoque" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Atualizar Estoque</button>
        </form>
    </div>
</body>
</html>

<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;
use App\Application\ProductService;

$file = __DIR__ . '/../storage/products.txt';

$repo = new FileProductRepository($file);
$validator = new SimpleProductValidator();
$service = new ProductService($repo, $validator);

$products = $service->list();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Produtos Cadastrados</title>
    <style>
        body { font-family: Arial; margin: 2rem; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #aaa; padding: 8px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h1>Produtos</h1>
    <p><a href="index.php">Cadastrar novo</a></p>
<?php if (count($products) === 0): ?>
    <p>Nenhum produto cadastrado.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= (int) $p['id'] ?></td>
                <td><?= htmlspecialchars($p['name']) ?></td>
                <td>R$ <?= number_format($p['price'], 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>

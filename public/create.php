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

$input = [
    'name' => $_POST['name'] ?? null,
    'price' => $_POST['price'] ?? null,
];

$result = $service->create($input);

if (isset($result['errors'])) {
    http_response_code(422);
    echo '<h1>Erro de validação</h1><ul>';
    foreach ($result['errors'] as $err) {
        echo '<li>' . htmlspecialchars($err) . '</li>';
    }
    echo '</ul><p><a href="index.php">Voltar</a></p>';
    exit;
}

header('Location: products.php');
exit;

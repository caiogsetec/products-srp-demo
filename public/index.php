<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastrar Produto</title>
</head>
<body>
    <h1>Cadastrar Produto</h1>
    <form action="create.php" method="post">
        <div>
            <label for="name">Nome:</label>
            <input id="name" name="name" type="text" required maxlength="100">
        </div>
        <div>
            <label for="price">Preço:</label>
            <input id="price" name="price" type="text" required>
        </div>
        <div>
            <button type="submit">Cadastrar</button>
            <a href="products.php">Ver produtos</a>
        </div>
    </form>
</body>
</html>

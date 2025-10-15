<?php

declare(strict_types=1);

namespace App\Domain;

use App\Contracts\ProductValidator;

final class SimpleProductValidator implements ProductValidator
{
    public function validate(array $input): array
    {
        $errors = [];

        $name = isset($input['name']) ? trim((string) $input['name']) : '';
        $price = $input['price'] ?? null;

        if ($name === '') {
            $errors[] = 'O nome é obrigatório.';
        } elseif (mb_strlen($name) < 2) {
            $errors[] = 'O nome deve ter pelo menos 2 caracteres.';
        } elseif (mb_strlen($name) > 100) {
            $errors[] = 'O nome deve ter no máximo 100 caracteres.';
        }

        if (!is_numeric($price)) {
            $errors[] = 'O preço deve ser um número.';
        } elseif ((float) $price < 0) {
            $errors[] = 'O preço não pode ser negativo.';
        }

        return $errors;
    }
}

<?php

declare(strict_types=1);

namespace App\Contracts;

interface ProductValidator
{
    /**
     * @param array{name?:mixed,price?:mixed} $input
     * @return string[] Lista de erros
     */
    public function validate(array $input): array;
}

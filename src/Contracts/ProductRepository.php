<?php

declare(strict_types=1);

namespace App\Contracts;

interface ProductRepository
{
    /**
     * @param array{id:int,name:string,price:float} $product
     * @return void
     */
    public function save(array $product): void;

    /**
     * @return array<int,array{id:int,name:string,price:float}>
     */
    public function findAll(): array;
}

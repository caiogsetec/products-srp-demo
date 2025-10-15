<?php

declare(strict_types=1);

namespace App\Application;

use App\Contracts\ProductRepository;
use App\Contracts\ProductValidator;

final class ProductService
{
    private ProductRepository $repository;
    private ProductValidator $validator;

    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $input): array
    {
        $errors = $this->validator->validate($input);
        if ($errors) {
            return ['errors' => $errors];
        }

        $name = trim((string) $input['name']);
        $price = (float) $input['price'];

        $products = $this->repository->findAll();
        $lastId = 0;
        foreach ($products as $p) {
            if ($p['id'] > $lastId) {
                $lastId = $p['id'];
            }
        }

        $product = [
            'id' => $lastId + 1,
            'name' => $name,
            'price' => $price,
        ];

        $this->repository->save($product);

        return ['product' => $product];
    }

    public function list(): array
    {
        return $this->repository->findAll();
    }
}

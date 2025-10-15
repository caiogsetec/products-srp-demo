<?php

declare(strict_types=1);

namespace App\Infra;

use App\Contracts\ProductRepository;

final class FileProductRepository implements ProductRepository
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
        $dir = dirname($file);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($file)) {
            touch($file);
        }
    }

    public function save(array $product): void
    {
        $line = json_encode($product, JSON_UNESCAPED_UNICODE);
        file_put_contents($this->file, $line . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function findAll(): array
    {
        $products = [];
        if (!file_exists($this->file)) {
            return $products;
        }

        $lines = file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
        foreach ($lines as $line) {
            $data = json_decode($line, true);
            if (is_array($data)) {
                $data['id'] = (int) ($data['id'] ?? 0);
                $data['name'] = (string) ($data['name'] ?? '');
                $data['price'] = (float) ($data['price'] ?? 0);
                $products[] = $data;
            }
        }

        return $products;
    }
}

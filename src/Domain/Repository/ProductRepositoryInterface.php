<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Product as ProductDomain;

interface ProductRepositoryInterface
{
    public function saveProduct(ProductDomain $entry): void;
    public function searchProduct(int $id): ProductDomain;
    public function flush(): void;
}
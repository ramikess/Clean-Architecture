<?php

namespace App\Catalog\Infrastructure\Persistence;

use App\Catalog\Domain\Aggregate\Product;
use App\Catalog\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }
}
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

    public function findByExternalIds(array $externalIds): array
    {
        $products = $this->entityManager
            ->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->where('p.externalId IN (:externalIds)')
            ->setParameter('externalIds', $externalIds)
            ->getQuery()
            ->getResult();

        $indexedProducts = [];

        foreach ($products as $product) {
            $indexedProducts[$product->getExternalId()] = $product;
        }

        return $indexedProducts;
    }

    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }
}
<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) { }

    public function saveProduct(Product $entry): void
    {
        $product = new Product();
        $product->setName($entry->getName());
        $product->setPrice($entry->getPrice());
        $product->setDescription($entry->getDescription());

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function searchProduct(int $id): Product
    {
        return $this->entityManager->getRepository(Product::class)->find($id);
    }
}

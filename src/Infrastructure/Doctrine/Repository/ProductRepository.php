<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\Product as ProductDomain;
use App\Domain\Repository\ProductRepositoryInterface;
use App\Infrastructure\DataMapper\ProductEntityMapper;
use App\Infrastructure\Doctrine\Entity\Product as ProductDoctrine;
use Doctrine\ORM\EntityManagerInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ProductEntityMapper $productEntityMapper
    ) { }

    public function saveProduct(ProductDomain $entry): void
    {
        $product = new ProductDoctrine();
        $product->setName($entry->getName());
        $product->setPrice($entry->getPrice());
        $product->setDescription($entry->getDescription());

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    public function searchProduct(int $id): ProductDomain
    {
        $productDoctrine = $this->entityManager->getRepository(ProductDoctrine::class)->find($id);
        return $this->productEntityMapper->convertToDomain($productDoctrine);
    }
}

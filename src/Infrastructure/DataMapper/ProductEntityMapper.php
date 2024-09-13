<?php

namespace App\Infrastructure\DataMapper;

use App\Domain\Entity\Product as ProductDomain;
use App\Infrastructure\Doctrine\Entity\Product as ProductDoctrine;

class ProductEntityMapper
{
    public function convertToDomain(ProductDoctrine $productDoctrine): ProductDomain
    {
        $productDomain = new ProductDomain();
        $productDomain->setId($productDoctrine->getId());
        $productDomain->setName($productDoctrine->getName());
        $productDomain->setPrice($productDoctrine->getPrice());
        $productDomain->setDescription($productDoctrine->getDescription());

        return $productDomain;
    }
}
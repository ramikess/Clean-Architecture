<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Command\Product\CreateProductRequest;
use App\Domain\Entity\Product;

class ProductService
{
    public function __construct(
    ) { }


    public function createProduct(CreateProductRequest $request): Product
    {
        $product = new Product();
        $product->setName($request->getName());
        $product->setPrice($request->getPrice());
        $product->setDescription($request->getDescription());
        $product->setQuantity($request->getQuantity());

        return $product;
    }
}
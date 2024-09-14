<?php

namespace App\Application\UseCase\Product;

use App\Application\DTO\CreateProductRequest;
use App\Application\DTO\ProductResponse;
use App\Application\Present\ProductPresenterInterface;
use App\Domain\Entity\Product;
use App\Domain\Repository\ProductRepositoryInterface;

class CreateProduct
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    ) { }

    public function execute(CreateProductRequest $request, ProductPresenterInterface $presenter): void
    {
        $product = new Product();
        $product->setName($request->getName());
        $product->setPrice($request->getPrice());
        $product->setDescription($request->getDescription());

        $this->productRepository->saveProduct($product);

        $presenter->present(new ProductResponse($product));
    }
}

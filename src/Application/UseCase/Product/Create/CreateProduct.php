<?php

namespace App\Application\UseCase\Product\Create;

use App\Application\UseCase\Product\Present\ProductPresenterInterface;
use App\Application\UseCase\Product\Response\ProductResponse;
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

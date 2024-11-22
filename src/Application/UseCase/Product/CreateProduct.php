<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product;

use App\Application\Command\Product\CreateProductRequest;
use App\Application\Present\ProductPresenterInterface;
use App\Application\Response\ProductResponse;
use App\Application\Service\ProductService;
use App\Domain\Repository\ProductRepositoryInterface;

class CreateProduct
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ProductService $productService
    ) { }

    public function execute(CreateProductRequest $request, ProductPresenterInterface $presenter): void
    {
        $product = $this->productService->createProduct($request);
        $this->productRepository->saveProduct($product);
        $presenter->present(new ProductResponse($product));
    }
}

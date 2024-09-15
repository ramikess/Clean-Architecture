<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product;

use App\Application\DTO\Product\ProductResponse;
use App\Application\DTO\Product\SearchProductRequest;
use App\Application\Present\ProductPresenterInterface;
use App\Domain\Repository\ProductRepositoryInterface;

class SearchProduct
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    ) { }

    public function execute(SearchProductRequest $request, ProductPresenterInterface $presenter): void
    {
        $product = $this->productRepository->searchProduct($request->getId());

        $presenter->present(new ProductResponse($product));
    }
}
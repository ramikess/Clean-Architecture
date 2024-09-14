<?php

declare(strict_types=1);

namespace App\Application\UseCase\Product;

use App\Application\DTO\ProductResponse;
use App\Application\DTO\UpdateProductPriceRequest;
use App\Application\Present\ProductPresenterInterface;
use App\Domain\Repository\ProductRepositoryInterface;

class UpdateProductPrice
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository
    ) { }

    public function execute(UpdateProductPriceRequest $request, ProductPresenterInterface $presenter): void
    {
        $product = $this->productRepository->searchProduct($request->getId());
        $product->setPrice($request->getNewPrice());

        $this->productRepository->flush();

        $presenter->present(new ProductResponse($product));
    }
}
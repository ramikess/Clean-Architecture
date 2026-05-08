<?php

declare (strict_types = 1);

namespace App\Catalog\Application\UseCase\ImportProducts;

use App\Catalog\Domain\ExternalCatalog\ProductProviderInterface;
use App\Catalog\Domain\Repository\ProductRepositoryInterface;

class ImportProductsUseCase
{
    public function __construct(
        private readonly ProductProviderInterface   $productProvider,
        private readonly ProductRepositoryInterface $productRepository,
    ) {}

    public function execute(ImportProductsRequest $request): int
    {
        $products = $this->productProvider->fetchAll($request->limit, $request->skip);

        foreach ($products as $product) {
            $this->productRepository->save($product);
        }

        $this->productRepository->flush();

        return count($products);
    }
}
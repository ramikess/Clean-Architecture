<?php

declare(strict_types=1);

namespace App\Catalog\Application\UseCase\ImportProducts;

use App\Catalog\Domain\ExternalCatalog\ProductProviderInterface;
use App\Catalog\Domain\Repository\ProductRepositoryInterface;

class ImportProductsUseCase
{
    private const BATCH_SIZE = 100;

    public function __construct(
        private readonly ProductProviderInterface $productProvider,
        private readonly ProductRepositoryInterface $productRepository,
    ) {
    }

    public function execute(ImportProductsRequest $request): int
    {
        $skip  = $request->skip;
        $total = 0;

        do {
            $products = $this->productProvider->fetchAll(
                limit: self::BATCH_SIZE,
                skip: $skip,
            );

            foreach ($products as $product) {
                $existing = $this->productRepository->findByExternalId(
                    $product->getExternalId()
                );

                if ($existing !== null) {
                    $existing->update(
                        title: $product->getTitle(),
                        description: $product->getDescription(),
                        price: (int) ($product->getPrice() * 100),
                        category: $product->getCategory(),
                        thumbnail: $product->getThumbnail(),
                        brand: $product->getBrand(),
                        rating: $product->getRating(),
                        stock: $product->getStock(),
                    );

                    continue;
                }

                $this->productRepository->save($product);
            }

            $this->productRepository->flush();

            $count  = count($products);
            $total += $count;
            $skip  += $count;

        } while ($count === self::BATCH_SIZE);

        return $total;
    }
}
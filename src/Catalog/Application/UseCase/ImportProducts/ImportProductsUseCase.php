<?php

declare(strict_types=1);

namespace App\Catalog\Application\UseCase\ImportProducts;

use App\Catalog\Domain\Aggregate\Product;
use App\Catalog\Domain\ExternalCatalog\ProductProviderInterface;
use App\Catalog\Domain\Repository\ProductRepositoryInterface;

final class ImportProductsUseCase
{
    private const DEFAULT_BATCH_SIZE = 100;

    public function __construct(
        private readonly ProductProviderInterface $productProvider,
        private readonly ProductRepositoryInterface $productRepository,
    ) {
    }

    public function execute(ImportProductsRequest $request): int
    {
        $skip       = $request->skip;
        $batchSize  = $request->limit ?: self::DEFAULT_BATCH_SIZE;
        $totalCount = 0;

        do {
            $products = $this->productProvider->fetchAll(
                limit: $batchSize,
                skip: $skip,
            );

            $count = count($products);

            if ($count === 0) {
                break;
            }

            $externalIds = array_map(
                static fn ($product) => $product->getExternalId(),
                $products
            );

            /**
             * @var array<string, Product> $existingProducts
             */
            $existingProducts = $this->productRepository
                ->findByExternalIds($externalIds);

            foreach ($products as $product) {
                $externalId = $product->getExternalId();

                $existingProduct = $existingProducts[$externalId] ?? null;

                if ($existingProduct !== null) {
                    $existingProduct->update(
                        title: $product->getTitle(),
                        description: $product->getDescription(),
                        price: (int) round($product->getPrice() * 100),
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

            $totalCount += $count;
            $skip += $count;

        } while ($count === $batchSize);

        return $totalCount;
    }
}
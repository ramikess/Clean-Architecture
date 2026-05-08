<?php

namespace App\Catalog\Infrastructure\Import\ExternalProducts;

use App\Catalog\Domain\Aggregate\Product;
use App\Catalog\Domain\ExternalCatalog\ProductProviderInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DummyJsonProductClient implements ProductProviderInterface
{

    private const API_URL = 'https://dummyjson.com/products';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {}

    /** @return Product[] */
    public function fetchAll(int $limit, int $skip): array
    {
        $response = $this->httpClient->request('GET', self::API_URL, [
            'query' => [
                'limit' => $limit,
                'skip'  => $skip,
            ],
        ]);

        $data = $response->toArray();

        return array_map(
            static fn(array $item): Product => new Product(
                externalId:  $item['id'],
                title:       $item['title'],
                description: $item['description'],
                price:       $item['price'] * 100,
                category:    $item['category'],
                thumbnail:   $item['thumbnail'],
                brand:       $item['brand'] ?? null,
                rating:      $item['rating'] ?? null,
                stock:       $item['stock'] ?? null,
            ),
            $data['products']
        );
    }
}
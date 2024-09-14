<?php

declare(strict_types=1);

namespace App\UserInterface\View\Product;

use App\Application\DTO\ProductResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ProductJsonView implements ProductViewInterface
{
    public function __construct(
        private readonly SerializerInterface $serializer
    ) { }

    public function generateResponse(ProductResponse $response): Response
    {
        return new JsonResponse(data: $this->serializer->serialize($response, 'json'), json: true);
    }
}
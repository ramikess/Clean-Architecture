<?php

declare(strict_types=1);

namespace App\UserInterface\View\Product;

use App\Application\DTO\ProductResponse;
use Symfony\Component\HttpFoundation\Response;

interface ProductViewInterface
{
    public function generateResponse(ProductResponse $response): Response;
}
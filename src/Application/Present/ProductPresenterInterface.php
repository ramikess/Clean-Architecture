<?php

namespace App\Application\Present;

use App\Application\DTO\Product\ProductResponse;

interface ProductPresenterInterface
{
    public function present(ProductResponse $response): void;
}
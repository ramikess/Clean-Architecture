<?php

namespace App\Application\Present;

use App\Application\Command\Product\ProductResponse;

interface ProductPresenterInterface
{
    public function present(ProductResponse $response): void;
}
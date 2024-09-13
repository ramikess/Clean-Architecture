<?php

namespace App\Application\UseCase\Product\Present;

use App\Application\UseCase\Product\Response\ProductResponse;

interface ProductPresenterInterface
{
    public function present(ProductResponse $response): void;
}
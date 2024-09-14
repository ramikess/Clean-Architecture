<?php

namespace App\Application\Present;

use App\Application\DTO\ProductResponse;

interface ProductPresenterInterface
{
    public function present(ProductResponse $response): void;
}
<?php

declare(strict_types=1);

namespace App\Application\Present;

use App\Application\Response\ProductResponse;

interface ProductPresenterInterface
{
    public function present(ProductResponse $response): void;
}
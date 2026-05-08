<?php

declare(strict_types=1);

namespace App\Catalog\Domain\ExternalCatalog;

use App\Catalog\Domain\Aggregate\Product;

interface ProductProviderInterface
{
    /** @return Product[] */
    public function fetchAll(int $limit, int $skip): array;
}
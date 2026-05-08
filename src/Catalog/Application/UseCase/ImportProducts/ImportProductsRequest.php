<?php

namespace App\Catalog\Application\UseCase\ImportProducts;

class ImportProductsRequest
{
    public function __construct(
        public readonly int $limit = 100,
        public readonly int $skip = 0,
    ) {}
}
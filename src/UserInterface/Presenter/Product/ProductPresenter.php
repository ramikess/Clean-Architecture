<?php

declare(strict_types=1);

namespace App\UserInterface\Presenter\Product;

use App\Application\UseCase\Product\Present\ProductPresenterInterface;
use App\Application\UseCase\Product\Response\ProductResponse;

class ProductPresenter implements ProductPresenterInterface
{
    private ProductResponse $response;
    public function present(ProductResponse $response): void
    {
        $this->response = $response;
    }

    public function getViewModel(): ProductResponse
    {
        return $this->response;
    }
}
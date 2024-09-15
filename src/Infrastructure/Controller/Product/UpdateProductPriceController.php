<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Product;

use App\Application\DTO\Product\UpdateProductPriceRequest;
use App\Application\Present\ProductPresenterInterface;
use App\Application\UseCase\Product\UpdateProductPrice;
use App\UserInterface\View\Product\ProductJsonView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/update/product/{id}/price/{price}',
    name: 'app_update_product_price',
    methods: [Request::METHOD_PATCH],
)]
class UpdateProductPriceController
{
    public function __invoke(
        UpdateProductPrice $updateProductPrice,
        Request $request,
        ProductPresenterInterface $presenter,
        ProductJsonView $view
    ): Response
    {
        $request = new UpdateProductPriceRequest(
            (int)$request->get('id'),
            (int)$request->get('price'),
        );

        $updateProductPrice->execute($request, $presenter);

        return $view->generateResponse($presenter->getViewModel());
    }
}

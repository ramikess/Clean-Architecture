<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\UseCase\Product\Present\ProductPresenterInterface;
use App\Application\UseCase\Product\Search\SearchProduct;
use App\Application\UseCase\Product\Search\SearchProductRequest;
use App\UserInterface\View\Product\ProductHtmlView;
use App\UserInterface\View\Product\ProductJsonView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/search/product/{id}',
    name: 'app_product_search',
    methods: [Request::METHOD_GET],
)]
class SearchProductController
{
    public function __invoke(
        SearchProduct $searchProduct,
        ProductPresenterInterface $presenter,
        Request $request,
        //ProductJsonView $view,
        ProductHtmlView $view,
    ): Response
    {

        $request = new SearchProductRequest(
            (int)$request->get('id'),
        );

        $searchProduct->execute($request, $presenter);

        return $view->generateResponse($presenter->getViewModel());
    }
}

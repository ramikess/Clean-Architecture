<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\Product;

use App\Application\Command\Product\CreateProductRequest;
use App\Application\Present\ProductPresenterInterface;
use App\Application\UseCase\Product\CreateProduct;
use App\UserInterface\View\Product\ProductJsonView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/product',
    name: 'app_product_create',
    methods: [Request::METHOD_POST],
)]
class CreateProductController
{
    public function __invoke(
        CreateProduct             $createProduct,
        ProductPresenterInterface $presenter,
        Request                   $request,
        ProductJsonView           $view
    ): Response
    {
        $request = new CreateProductRequest(
            $request->get('name'),
            (int)$request->get('price'),
            $request->get('description'),
            (int)$request->get('quantity'),
        );

        $createProduct->execute($request, $presenter);

        return $view->generateResponse($presenter->getViewModel());
    }
}

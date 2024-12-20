<?php

declare(strict_types=1);

namespace App\UserInterface\View\Product;

use App\Application\Response\ProductResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ProductHtmlView implements ProductViewInterface
{
    public function __construct(
        private readonly Environment $environment
    ) { }

    public function generateResponse(ProductResponse $response): Response
    {
        return new Response($this->environment->render('Page/Product/create.html.twig', [
            'viewModel' => $response,
        ]));
    }
}
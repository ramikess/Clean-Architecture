<?php

declare(strict_types=1);

namespace App\Catalog\UserInterface\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/products', 'app_product')]
class ProductController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('@Catalog/products.html.twig');
    }
}

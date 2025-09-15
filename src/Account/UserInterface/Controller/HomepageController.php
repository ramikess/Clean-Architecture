<?php

declare(strict_types=1);

namespace App\Account\UserInterface\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', 'app_homepage')]
class HomepageController extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render('@Account/Homepage/index.html.twig');
    }
}

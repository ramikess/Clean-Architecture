<?php

declare(strict_types=1);

namespace App\Account\UserInterface\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/login', name: 'app_login')]
class LoginController extends AbstractController
{

    public function __invoke(AuthenticationUtils $authenticationUtils)
    {
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('@Account/User/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }
}
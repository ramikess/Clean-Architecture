<?php

declare(strict_types=1);

namespace App\Account\UserInterface\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/login', name: 'app_login')]
class LoginController extends AbstractController
{

    public function __invoke(AuthenticationUtils $authenticationUtils): RedirectResponse|Response
    {
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('app_homepage');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@Account/User/login.html.twig', [
            'last_username' => $lastUsername,
            'error_message' => $error?->getMessage(),
        ]);
    }
}
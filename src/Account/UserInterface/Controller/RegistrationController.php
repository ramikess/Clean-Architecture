<?php

declare(strict_types=1);

namespace App\Account\UserInterface\Controller;

use App\Account\Application\Exception\EmailAlreadyUsedException;
use App\Account\Application\UseCase\RegisterUserUseCase;
use App\Account\Infrastructure\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/register', name: 'app_register')]
class RegistrationController extends AbstractController
{

    /**
     * @throws EmailAlreadyUsedException
     */
    public function __invoke(Request $request, RegisterUserUseCase $registerUser): Response|RedirectResponse
    {
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('app_homepage');
        }
        $form = $this->createForm(RegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $plainPassword = $form->get('plainPassword')->getData();

            try {
                $registerUser($email, $plainPassword);

                $this->addFlash('success', 'Your account has been successfully created!');
                return $this->redirectToRoute('app_login');

            } catch (EmailAlreadyUsedException $exception) {
                $form->get('email')->addError(new FormError($exception->getMessage()));
            }
        }

        return $this->render('@Account/User/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
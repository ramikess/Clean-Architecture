<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\User;

use App\Application\Command\User\CreateUserRequest;
use App\Application\Present\UserPresentInterface;
use App\Application\UseCase\User\CreateUser;
use App\UserInterface\View\User\UserJsonView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route(
    path: '/user',
    name: 'app_user_create',
    methods: [Request::METHOD_POST],
)]
class CreateUserController
{
    public function __invoke(
        Request $request,
        CreateUser $createUser,
        UserPresentInterface $presenter,
        UserJsonView $view
    ) {
        $request = new CreateUserRequest(
            $request->get('email'),
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('password'),
        );

        $createUser->execute($request, $presenter);

        return $view->generateResponse($presenter->getViewModel());
    }
}
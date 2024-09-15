<?php

declare(strict_types=1);

namespace App\UserInterface\View\User;

use App\Application\Command\User\UserResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class UserJsonView
{
    public function __construct(
        private readonly SerializerInterface $serializer
    ) { }

    public function generateResponse(UserResponse $response): Response
    {
        return new JsonResponse(data: $this->serializer->serialize($response, 'json'), json: true);
    }
}
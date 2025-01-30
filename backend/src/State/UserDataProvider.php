<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ScoreRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class UserDataProvider implements ProviderInterface
{

    private TokenStorageInterface $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $token = $this->tokenStorage->getToken();

        if ($token) {
            $user = $token->getUser();
            
            if ($user) {
                // Assuming the user object has a method getId() to get the user ID
                $userId = $user->getId();
                return [
                    'id' => $userId,
                    'username' => $user->getUsername()
                ];
            }
        }
    }
}

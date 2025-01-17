<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ScoreRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ScoreDataProvider implements ProviderInterface
{
    private ScoreRepository $scoreRepository;
    private TokenStorageInterface $tokenStorage;

    public function __construct(ScoreRepository $scoreRepository, TokenStorageInterface $tokenStorage)
    {
        $this->scoreRepository = $scoreRepository;
        $this->tokenStorage = $tokenStorage;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // Get the authenticated user from the token storage
        $token = $this->tokenStorage->getToken();

        if ($token) {
            $user = $token->getUser();
            if ($user) {
                // Assuming the user object has a method getId() to get the user ID
                $userId = $user->getId();
                $score = $this->scoreRepository->findOneByUser($user);
                
                return [
                    'id' => $score->getId(),
                    'points' => $score->getPoints(),
                ];
            }
        }

        return null;
    }
}

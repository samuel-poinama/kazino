<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Score;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ScoreDataProcessor implements ProcessorInterface
{
    private EntityManagerInterface $entityManager;
    private TokenStorageInterface $tokenStorage;


    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        $token = $this->tokenStorage->getToken();


        if ($token) {
            $user = $token->getUser();
            if ($user) {


                if ($data->getPoints()) {
                    $data->setUser($user);
                    $points = $data->getPoints();

                    $score = $this->entityManager->getRepository(Score::class)->findOneByUser($user);
                    // Persist the updated Score entity
                    $score->setPoints($points);
                    $this->entityManager->flush();
                }
            }
        }
        // Assuming $data is an instance of Score
        
    }
}

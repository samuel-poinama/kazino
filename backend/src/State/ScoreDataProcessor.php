<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Score;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\Worker;

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


                if ($data->points) {
                    $points = $data->points;

                    $score = $this->entityManager->getRepository(Score::class)->findOneByUser($user);

                    // get workers 
                    $userId = $user->getId();
                    $workers = $this->entityManager->getRepository(Worker::class)->findByUserId($userId);
                    for ($i = 0; $i < count($workers); $i++) {
                        $product = $workers[$i]->getProduct();
                        $points += $product->getRate();

                    }

                    // Persist the updated Score entity
                    $score->setPoints($score->getPoints() + $points);
                    $this->entityManager->flush();
                }
            }
        }
        
    }
}

<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\Score;

class RegisterStateProcessor implements ProcessorInterface
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
        // get user password and name
        $username = $data->getUsername();
        $password = $data->getPassword();

        // hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // set the hashed password
        $data->setPassword($hashedPassword);

        // persist the user
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        // create a score for the user
        $score = new Score();
        $score->setUser($data);
        $score->setPoints(0);

        // persist the score
        $this->entityManager->persist($score);
        $this->entityManager->flush();
    }
}

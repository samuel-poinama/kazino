<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

class ProductDataProvider implements ProviderInterface
{

    private TokenStorageInterface $tokenStorage;
    private EntityManagerInterface $entityManager;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $token = $this->tokenStorage->getToken();

        if ($token) {
            $user = $token->getUser();
            
            if ($user) {
                $products = $this->entityManager->getRepository(Product::class)->getAll($user);
                return $products;
            }
        }
    }
}

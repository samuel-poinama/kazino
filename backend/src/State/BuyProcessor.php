<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\Worker;
use App\Entity\Product;
use App\Entity\Score;


class BuyProcessor implements ProcessorInterface
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
                // get product Id from body
                $productId = $data->productId;

                // get product by Id
                $product = $this->entityManager->getRepository(Product::class)->getById($productId);

                $price = $product->getPrice();

                $score = $this->entityManager->getRepository(Score::class)->findOneByUser($user);
                $points = $score->getPoints();
                if ($points < $price) return;

                $score->setPoints($points - $price);
                $this->entityManager->persist($score);

                $worker = new Worker();
                $worker->setUser($user);
                
                

                // set product to worker
                $worker->setProduct($product);

                $this->entityManager->persist($worker);
                $this->entityManager->flush();
            }
        }
    }
}

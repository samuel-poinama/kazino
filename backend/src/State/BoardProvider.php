<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Score;

class BoardProvider implements ProviderInterface
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $data = $this->entityManager->getRepository(Score::class)->getFirst(100);

        return array_map(function ($item) {
            return [
                "id" => $item->getId(),
                "points" => $item->getPoints(),
                "username" => $item->getUser()->getUsername()
            ];
        }, $data);
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ScoreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Put;
use App\State\ScoreDataProvider;
use App\State\ScoreDataProcessor;
use App\Dto\ScoreResponse;
use App\State\BoardProvider;
use App\Dto\BoardResponse;
use App\Dto\ScoreRequest;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/score',
            provider: ScoreDataProvider::class,
            output: ScoreResponse::class
        ),
        new Put(
            uriTemplate: '/score/add',
            input: ScoreRequest::class,
            processor: ScoreDataProcessor::class,
            read: false,
            write: true,
            provider: ScoreDataProvider::class,
        ),
        new Get(
            uriTemplate: '/leaderboard',
            provider: BoardProvider::class,
            output: BoardResponse::class
        )
    ]
)]
class Score
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $points = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoints(): ?string
    {
        return $this->points;
    }

    public function setPoints(string $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}

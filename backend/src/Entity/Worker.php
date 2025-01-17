<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WorkerRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Post;
use ApiPlatform\MetaData\Get;
use App\State\BuyProcessor;
use App\Dto\BuyRequest;
use App\State\WorkerProvider;
use App\Dto\WorkerResponse;

#[ORM\Entity(repositoryClass: WorkerRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/workers',
            provider: WorkerProvider::class,   
            output: WorkerResponse::class,
        ),
        new Post(
            uriTemplate: '/buy',
            processor: BuyProcessor::class,
            input: BuyRequest::class
            
        ),
    ]
)]
class Worker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?User $User = null;

    #[ORM\ManyToOne]
    private ?Product $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }
}

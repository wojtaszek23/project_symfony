<?php

namespace App\Entity;

use App\Repository\GreetingsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GreetingsRepository::class)]
class Greetings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $person = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerson(): ?string
    {
        return $this->person;
    }

    public function setPerson(?string $person): static
    {
        $this->person = $person;

        return $this;
    }
}

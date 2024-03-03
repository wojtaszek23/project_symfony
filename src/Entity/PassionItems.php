<?php

namespace App\Entity;

use App\Repository\PassionItemsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassionItemsRepository::class)]
class PassionItems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $image;

    #[ORM\ManyToOne(targetEntity: Passions::class, inversedBy: 'passionItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?passions $passionTypeId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPassionTypeId(): ?passions
    {
        return $this->passionTypeId;
    }

    public function setPassionTypeId(?passions $passionTypeId): static
    {
        $this->passionTypeId = $passionTypeId;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\PassionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassionsRepository::class)]
class Passions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: PassionItems::class, mappedBy: 'passionTypeId', orphanRemoval: true)]
    private Collection $passionItems;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageName = null;

    public function __construct()
    {
        $this->passionItems = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, PassionItems>
     */
    public function getPassionItems(): Collection
    {
        return $this->passionItems;
    }

    public function addPassionItem(PassionItems $passionItem): static
    {
        if (!$this->passionItems->contains($passionItem)) {
            $this->passionItems->add($passionItem);
            $passionItem->setPassionTypeId($this);
        }

        return $this;
    }

    public function removePassionItem(PassionItems $passionItem): static
    {
        if ($this->passionItems->removeElement($passionItem)) {
            // set the owning side to null (unless already changed)
            if ($passionItem->getPassionTypeId() === $this) {
                $passionItem->setPassionTypeId(null);
            }
        }

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): static
    {
        $this->imageName = $imageName;

        return $this;
    }
}

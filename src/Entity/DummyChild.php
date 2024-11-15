<?php

namespace App\Entity;

use App\Repository\DummyChildRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DummyChildRepository::class)]
class DummyChild
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'dummyChildren')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DummyParent $dummyParent = null;

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

    public function getDummyParent(): ?DummyParent
    {
        return $this->dummyParent;
    }

    public function setDummyParent(?DummyParent $dummyParent): static
    {
        $this->dummyParent = $dummyParent;

        return $this;
    }
}

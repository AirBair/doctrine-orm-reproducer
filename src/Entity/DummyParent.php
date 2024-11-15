<?php

namespace App\Entity;

use App\Repository\DummyParentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DummyParentRepository::class)]
class DummyParent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, DummyChild>
     */
    #[ORM\OneToMany(targetEntity: DummyChild::class, mappedBy: 'dummyParent', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $dummyChildren;

    public function __construct()
    {
        $this->dummyChildren = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, DummyChild>
     */
    public function getDummyChildren(): Collection
    {
        return $this->dummyChildren;
    }

    public function addDummyChild(DummyChild $dummyChild): static
    {
        if (!$this->dummyChildren->contains($dummyChild)) {
            $this->dummyChildren->add($dummyChild);
            $dummyChild->setDummyParent($this);
        }

        return $this;
    }

    public function removeDummyChild(DummyChild $dummyChild): static
    {
        if ($this->dummyChildren->removeElement($dummyChild)) {
            // set the owning side to null (unless already changed)
            if ($dummyChild->getDummyParent() === $this) {
                $dummyChild->setDummyParent(null);
            }
        }

        return $this;
    }
}

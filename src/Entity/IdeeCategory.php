<?php

namespace App\Entity;

use App\Repository\IdeeCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IdeeCategoryRepository::class)
 */
class IdeeCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Idee::class, mappedBy="ideeCategory", orphanRemoval=true)
     */
    private $ideeCat;

    public function __construct()
    {
        $this->ideeCat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|Idee[]
     */
    public function getIdeeCat(): Collection
    {
        return $this->ideeCat;
    }

    public function addIdeeCat(Idee $ideeCat): self
    {
        if (!$this->ideeCat->contains($ideeCat)) {
            $this->ideeCat[] = $ideeCat;
            $ideeCat->setIdeeCategory($this);
        }

        return $this;
    }

    public function removeIdeeCat(Idee $ideeCat): self
    {
        if ($this->ideeCat->removeElement($ideeCat)) {
            // set the owning side to null (unless already changed)
            if ($ideeCat->getIdeeCategory() === $this) {
                $ideeCat->setIdeeCategory(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\IdeeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IdeeRepository::class)
 */
class Idee
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
     * @ORM\ManyToOne(targetEntity=IdeeCategory::class, inversedBy="ideeCat")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ideeCategory;

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

    public function getIdeeCategory(): ?IdeeCategory
    {
        return $this->ideeCategory;
    }

    public function setIdeeCategory(?IdeeCategory $ideeCategory): self
    {
        $this->ideeCategory = $ideeCategory;

        return $this;
    }
}

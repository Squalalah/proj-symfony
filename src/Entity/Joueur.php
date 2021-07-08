<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JoueurRepository::class)
 */
class Joueur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\ManyToMany(targetEntity=Equipe::class, inversedBy="joueurs")
     */
    private $EquipeId;

    public function __construct()
    {
        $this->EquipeId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Equipe[]
     */
    public function getEquipeId(): Collection
    {
        return $this->EquipeId;
    }

    public function addEquipeId(Equipe $equipeId): self
    {
        if (!$this->EquipeId->contains($equipeId)) {
            $this->EquipeId[] = $equipeId;
        }

        return $this;
    }

    public function removeEquipeId(Equipe $equipeId): self
    {
        $this->EquipeId->removeElement($equipeId);

        return $this;
    }
}

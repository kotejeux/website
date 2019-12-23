<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auteur
 *
 * @ORM\Table(name="auteur")
 * @ORM\Entity
 */
class Auteur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Prenom", type="string", length=32, nullable=true)
     */
    private $prenom;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Nom", type="integer", nullable=true)
     */
    private $nom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?int
    {
        return $this->nom;
    }

    public function setNom(?int $nom): self
    {
        $this->nom = $nom;

        return $this;
    }


}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jeux
 *
 * @ORM\Table(name="jeux", indexes={@ORM\Index(name="Titre", columns={"Titre"})})
 * @ORM\Entity
 */
class Jeux
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
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=32, nullable=false)
     */
    private $titre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="joueurs_max", type="integer", nullable=false)
     */
    private $joueursMax;

    /**
     * @var int
     *
     * @ORM\Column(name="joueurs_min", type="integer", nullable=false)
     */
    private $joueursMin;

    /**
     * @var int
     *
     * @ORM\Column(name="duree", type="integer", nullable=false, options={"comment"="en minutes"})
     */
    private $duree;

    /**
     * @var int
     *
     * @ORM\Column(name="editeur", type="integer", nullable=false)
     */
    private $editeur;

    /**
     * @var int
     *
     * @ORM\Column(name="genre", type="integer", nullable=false)
     */
    private $genre;

    /**
     * @var int
     *
     * @ORM\Column(name="auteur", type="integer", nullable=false)
     */
    private $auteur;

    /**
     * @var int
     *
     * @ORM\Column(name="annee", type="integer", nullable=false)
     */
    private $annee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getJoueursMax(): ?int
    {
        return $this->joueursMax;
    }

    public function setJoueursMax(int $joueursMax): self
    {
        $this->joueursMax = $joueursMax;

        return $this;
    }

    public function getJoueursMin(): ?int
    {
        return $this->joueursMin;
    }

    public function setJoueursMin(int $joueursMin): self
    {
        $this->joueursMin = $joueursMin;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getEditeur(): ?int
    {
        return $this->editeur;
    }

    public function setEditeur(int $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getGenre(): ?int
    {
        return $this->genre;
    }

    public function setGenre(int $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAuteur(): ?int
    {
        return $this->auteur;
    }

    public function setAuteur(int $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }


}

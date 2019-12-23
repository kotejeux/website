<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Locations
 *
 * @ORM\Table(name="locations", indexes={@ORM\Index(name="date_debut", columns={"date_debut"}), @ORM\Index(name="fin_location", columns={"date_fin"})})
 * @ORM\Entity
 */
class Locations
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
     * @var int
     *
     * @ORM\Column(name="personne_id", type="integer", nullable=false)
     */
    private $personneId;

    /**
     * @var int
     *
     * @ORM\Column(name="jeu_id", type="integer", nullable=false)
     */
    private $jeuId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut", type="date", nullable=false)
     */
    private $dateDebut;

    /**
     * @var int
     *
     * @ORM\Column(name="date_fin", type="integer", nullable=false)
     */
    private $dateFin;

    /**
     * @var bool
     *
     * @ORM\Column(name="paye", type="boolean", nullable=false)
     */
    private $paye;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonneId(): ?int
    {
        return $this->personneId;
    }

    public function setPersonneId(int $personneId): self
    {
        $this->personneId = $personneId;

        return $this;
    }

    public function getJeuId(): ?int
    {
        return $this->jeuId;
    }

    public function setJeuId(int $jeuId): self
    {
        $this->jeuId = $jeuId;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?int
    {
        return $this->dateFin;
    }

    public function setDateFin(int $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getPaye(): ?bool
    {
        return $this->paye;
    }

    public function setPaye(bool $paye): self
    {
        $this->paye = $paye;

        return $this;
    }


}

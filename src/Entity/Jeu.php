<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JeuRepository")
 */
class Jeu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $joueurs_min;

    /**
     * @ORM\Column(type="integer")
     */
    private $joueurs_max;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="integer")
     */
    private $anne;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Location", mappedBy="jeu")
     */
    private $locations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\editeur", inversedBy="jeux")
     */
    private $editeur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\genre", inversedBy="jeux")
     */
    private $genre;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\auteur", inversedBy="jeux")
     */
    private $auteur;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
        $this->genre = new ArrayCollection();
        $this->auteur = new ArrayCollection();
    }

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

    public function getJoueursMin(): ?int
    {
        return $this->joueurs_min;
    }

    public function setJoueursMin(int $joueurs_min): self
    {
        $this->joueurs_min = $joueurs_min;

        return $this;
    }

    public function getJoueursMax(): ?int
    {
        return $this->joueurs_max;
    }

    public function setJoueursMax(int $joueurs_max): self
    {
        $this->joueurs_max = $joueurs_max;

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

    public function getAnne(): ?int
    {
        return $this->anne;
    }

    public function setAnne(int $anne): self
    {
        $this->anne = $anne;

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

    /**
     * @return Collection|Location[]
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setJeu($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->contains($location)) {
            $this->locations->removeElement($location);
            // set the owning side to null (unless already changed)
            if ($location->getJeu() === $this) {
                $location->setJeu(null);
            }
        }

        return $this;
    }

    public function getEditeur(): ?editeur
    {
        return $this->editeur;
    }

    public function setEditeur(?editeur $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * @return Collection|genre[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(genre $genre): self
    {
        if ($this->genre->contains($genre)) {
            $this->genre->removeElement($genre);
        }

        return $this;
    }

    /**
     * @return Collection|auteur[]
     */
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(auteur $auteur): self
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur[] = $auteur;
        }

        return $this;
    }

    public function removeAuteur(auteur $auteur): self
    {
        if ($this->auteur->contains($auteur)) {
            $this->auteur->removeElement($auteur);
        }

        return $this;
    }
}

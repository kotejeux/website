<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre", uniqueConstraints={@ORM\UniqueConstraint(name="genre", columns={"genre"})})
 * @ORM\Entity
 */
class Genre
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
     * @ORM\Column(name="genre", type="string", length=32, nullable=false)
     */
    private $genre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }


}

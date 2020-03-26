<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavoriteJokeRepository")
 */
class FavoriteJoke
{
    /**
     * int
     */
    public const MAXIMUM_AMOUNT_FAVORITES = 10;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)

     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(name="joke_id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $joke_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $joke;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getJokeId(): ?int
    {
        return $this->joke_id;
    }

    public function setJokeId(int $joke_id): self
    {
        $this->joke_id = $joke_id;

        return $this;
    }

    public function getJoke(): ?string
    {
        return $this->joke;
    }

    public function setJoke(string $joke): self
    {
        $this->joke = $joke;

        return $this;
    }
}

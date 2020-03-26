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
     * @ORM\Column(name="joke_id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $joke_id;

    public function getJokeId(): ?int
    {
        return $this->joke_id;
    }

    public function setJokeId(int $joke_id): self
    {
        $this->joke_id = $joke_id;

        return $this;
    }
}

<?php


namespace App\Controller;


use App\Entity\FavoriteJoke;
use App\HttpClient\JokeHttpClient;
use App\Repository\FavoriteJokeRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use function var_dump;

class FavoriteJokeController
{
    /**
     * @var FavoriteJokeRepository
     */
    private $repository;

    /**
     * @param FavoriteJokeRepository $repository
     */
    public function __construct(
        FavoriteJokeRepository $repository
    ){
        $this->repository = $repository;
    }

    /**
     * @Route("/save/{joke_id}")
     * @param int $joke_id
     * @return JsonResponse
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function saveJokeToFavorites(int $joke_id) : JsonResponse
    {
        echo $joke_id;
        $criteria = ['id' => ''];
        $amountFavoriteJokes = $this->repository->favoriteJokesAmount($criteria);
        if ($amountFavoriteJokes == FavoriteJoke::MAXIMUM_AMOUNT_FAVORITES) {
        return new JsonResponse(['result' => 'maximum amount of favorite jokes reached']);
        }

        return new JsonResponse(['result' => 'joke saved, nr. '.$amountFavoriteJokes]);
    }

    /**
     * @Route("/remove/{id}", methods={"DELETE"})
     * @param int $id
     * @return JsonResponse
     */
    public function removeJokesFromFavorites(int $id) {

        return new JsonResponse(['result' => 'joke removed']);
    }

    /**
     * @Route("/favorites")
     * @return JsonResponse
     */
    public function getFavoriteJokes() : JsonResponse
    {
        return new JsonResponse($this->repository->findAll());
    }
}
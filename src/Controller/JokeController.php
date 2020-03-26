<?php


namespace App\Controller;

use App\Entity\FavoriteJoke;
use App\HttpClient\JokeHttpClient;
use App\Repository\FavoriteJokeRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class JokeController
{
    /**
     * @var FavoriteJokeRepository
     */
    private $repository;

    /**
     * @var JokeHttpClient
     */
    private $httpClient;

    /**
     * @param FavoriteJokeRepository $repository
     */
    public function __construct(
        FavoriteJokeRepository $repository
    ){
        $this->repository = $repository;
        $this->httpClient = new JokeHttpClient;
    }

    /**
     * @Route("/jokes")
     * @return JsonResponse
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getTenRandomJokes(): JsonResponse
    {
        $jokes = $this->httpClient->getTenJokes();
        return new JsonResponse($jokes);
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
        $criteria = ['joke_id' => ''];
        $amountFavoriteJokes = $this->repository->favoriteJokesAmount($criteria);

        if ($this->repository->find($joke_id)) {
            return new JsonResponse(['result' => 'joke is already favorite']);
        } else if ($amountFavoriteJokes == FavoriteJoke::MAXIMUM_AMOUNT_FAVORITES) {
            return new JsonResponse(['result' => 'maximum amount of favorite jokes reached']);
        } else {
            $joke = new FavoriteJoke;
            $joke->setJokeId($joke_id);
            $this->repository->save($joke);
            return new JsonResponse(['result' => 'joke saved']);
        }
    }

    /**
     * @Route("/remove/{joke_id}")
     * @param int $joke_id
     * @return JsonResponse
     */
    public function removeJokeFromFavorites(int $joke_id) : JsonResponse
    {
        $joke = $this->repository->find($joke_id);
        if (!$joke) {
            return new JsonResponse(['result' => 'joke is not a favorite']);
        } else {
            $this->repository->remove($joke);
            return new JsonResponse(['result' => 'joke removed']);
        }
    }

    /**
     * @Route("/favorites")
     * @return JsonResponse
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function listFavorites() : JsonResponse
    {
        $jokes = $this->repository->findAll();
        foreach ($jokes as $joke) {
            $joke = $this->httpClient->getSingleJoke($joke->getJokeId());
                $favoriteJokes[] = $joke;
        }

        return new JsonResponse($favoriteJokes);
    }

}
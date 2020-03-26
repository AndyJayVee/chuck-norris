<?php


namespace App\Controller;


use App\HttpClient\JokeHttpClient;
use App\Repository\JokeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class JokeController
{
    /**
     * @var JokeRepository
     */
    private $repository;

    /**
     * @param JokeRepository $repository
     */
    public function __construct(
        JokeRepository $repository
    ){
        $this->repository = $repository;
    }

    /**
     * @Route("/jokes")

     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getTenRandomJokes() //: JsonResponse
    {
        $jokes = (new JokeHttpClient())->getTenJokes();
        $this->repository->saveAll($jokes);
//        return new JsonResponse($jokes);
    }
}
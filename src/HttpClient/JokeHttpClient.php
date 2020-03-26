<?php


namespace App\HttpClient;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use function var_dump;

class JokeHttpClient
{
    protected $client;

    public function __construct()
    {
        $this->client = HttpClient::create();
    }

    /**
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getTenJokes()
    {

        $HttpResponse = $this->client->request('POST', 'http://api.icndb.com/jokes/random/10');
        $jsonString = $HttpResponse->getContent();
        $array = json_decode($jsonString, false);
        $array = $array['value'];


        return $array;
    }

    public function getSingleJoke(int $joke_id)
    {
        $HttpResponse = $this->client->request('POST', 'http://api.icndb.com/jokes/'.$joke_id);
        var_dump($HttpResponse);
    }
}
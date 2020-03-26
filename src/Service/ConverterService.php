<?php


namespace App\Service;

use function json_encode;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Joke;
use function var_dump;

class ConverterService
{
    /**
     * @param string $jsonString
     * @return JsonResponse
     */
    public function convertJsonStringToObjects(string $jsonString) : JsonResponse
    {
        $array = json_decode($jsonString, true);
        $array = $array['value'];
        $jokeArray = [];
        $id = 0;

        foreach($array as $value) {
            $joke = new Joke;
            $joke->setId($id++);
            $joke->setJokeId($value['id']);
            $joke->setJoke($value['joke']);
            $jokeArray[] = $joke;
        }
        var_dump($jokeArray);

        return json_encode($jokeArray);
    }
}

<?php


namespace App\Clients;

use App\Abstracts\JokesAbstract;

class OfficialJokeAPI extends JokesAbstract
{
    protected string $path = "https://official-joke-api.appspot.com/random_ten";

    public function url(): string
    {
        return $this->path;
    }

    public function getJoke(object $joke): string
    {
        return "{$joke->setup} {$joke->punchline}";
    }

    public function setJokes(object $response): JokesAbstract
    {
        $body = json_decode((string) $response->getBody());
        $this->jokes = collect(is_array($body) ? $body : [$body]);

        return $this;
    }
}
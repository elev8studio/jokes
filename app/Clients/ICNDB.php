<?php


namespace App\Clients;

use App\Abstracts\JokesAbstract;

class ICNDB extends JokesAbstract
{
    protected string $path = "http://api.icndb.com/jokes/random/";

    public function url(): string
    {
        return $this->path . $this->getQuantity();
    }

    public function getJoke(object $joke)
    {
        return $joke->joke;
    }

    public function setJokes(object $response): JokesAbstract
    {
        $this->jokes = collect(json_decode((string) $response->getBody())->value);

        return $this;
    }
}
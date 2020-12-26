<?php

namespace App\Abstracts;

use App\Http\Requests\JokesRequest;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Collection;

abstract class JokesAbstract
{
    protected Client $client;
    protected Request $request;
    protected object $response;
    protected string $path;
    protected int $quantity;
    protected Collection $jokes;

    public function __construct(JokesRequest $jokesRequest)
    {
        $this->client = new Client();
        $this->quantity = $jokesRequest->getQuantity();
    }

    abstract public function url(): string;

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @throws Exception
     */
    public function sendRequest(): self
    {
        try {
            $this->response = $this->client->request(
                'GET',
                $this->url()
            );

            return $this;
        } catch (GuzzleException $e) {
            throw new Exception($e);
        }
    }

    public function handleResponse(): array
    {
        $this->setJokes($this->response);

        return $this->getJokes()->map(function ($joke) {
            return $this->getJoke($joke);
        })->all();
    }

    abstract public function setJokes(object $response): self;

    public function getJokes(): Collection
    {
        return $this->jokes;
    }
}

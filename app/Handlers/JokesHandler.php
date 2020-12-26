<?php

namespace App\Handlers;

use App\Abstracts\JokesAbstract as JokesAbstract;
use Exception;

class JokesHandler
{
    /**
     * @param JokesAbstract $jokes
     * @return array
     * @throws Exception
     */
    public function getJokes(JokesAbstract $jokes): array
    {
        try {
            return $jokes->sendRequest()
                ->handleResponse();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
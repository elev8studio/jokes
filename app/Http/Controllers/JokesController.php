<?php

namespace App\Http\Controllers;

use App\Clients\ICNDB;
use App\Clients\OfficialJokeAPI;
use App\Handlers\JokesHandler;
use App\Http\Requests\JokesRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class JokesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param JokesRequest $jokesRequest
     * @return JsonResponse
     * @throws Exception
     */
    public function index(JokesRequest $jokesRequest): JsonResponse
    {
        $handler = new JokesHandler();
        $jokesOne = $handler->getJokes(new ICNDB($jokesRequest));
        $jokesTwo = $handler->getJokes(new OfficialJokeAPI($jokesRequest));

        return response()->json([
            'jokes' => array_merge($jokesOne, $jokesTwo),
        ], 200);
    }
}

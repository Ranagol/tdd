<?php

namespace App\Http\Controllers;

use App\Services\ChuckNorrisService;
use App\Exceptions\DatabaseException;
use App\Exceptions\ChuckNorrisException;

class ChuckNorrisController extends Controller
{
    public function __invoke(ChuckNorrisService $chuckNorrisService)
    {
        try {
            $chuckNorrisService->getJoke();
        } catch (ChuckNorrisException $e) {
            return response()->json([
                'message' => 'Could not get joke from Chuck Norris API'
            ]);
        } catch (DatabaseException $e) {
            return response()->json([
                'message' => 'Could not save joke to the database'
            ]);
        }

        return response()->json([
            'message' => 'Chuck Norris joke received.'
        ]);
    }
}  
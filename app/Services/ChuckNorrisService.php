<?php

namespace App\Services;

use App\Models\Joke;
use App\Models\ChuckNorris;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Exceptions\ChuckNorrisException;

class ChuckNorrisService
{
    private string $url = 'https://api.chucknorris.io/jokes/random';

    /**
     * Gets jokes from API and saves them to the database.
     *
     * @throws ChuckNorrisException
     * @return void
     */
    public function getJoke(): void
    {
        try {
            $response = Http::get($this->url);
        } catch (\Exception $e) {
            throw new ChuckNorrisException('Could not get joke from Chuck Norris API');
        }

        //transform the json string to a php array
        $chuckNorrisJoke = $response->json();

        //save the joke to the database
        Joke::create([
            'joke' => $chuckNorrisJoke['value']
        ]);
    }
    
}
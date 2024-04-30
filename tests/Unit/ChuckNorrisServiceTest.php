<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Services\ChuckNorrisService;
use Illuminate\Support\Facades\Http;
use App\Exceptions\ChuckNorrisException;
use Exception;

/**
 * Command for running this test:
 * sail artisan test tests/Unit/ChuckNorrisServiceTest.php
 */
class ChuckNorrisServiceTest extends TestCase
{
    public function testWhenTheChuckNorrisApiResponseIsError(): void
    {
        // ARRANGE
        $chuckNorrisService = new ChuckNorrisService();

        Http::fake([
            'api.chucknorris.io/jokes/random' => Http::response([], 500),
        ]);

        $this->expectException(Exception::class);

        // ACT
        $chuckNorrisService->getJoke();
    }
}




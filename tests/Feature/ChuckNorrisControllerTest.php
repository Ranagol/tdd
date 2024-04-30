<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChuckNorrisControllerTest extends TestCase
{

    use RefreshDatabase;
    
    /**
     * sail artisan test --filter testJokeReceivedFromApi
     *
     * @return void
     */
    public function testJokeReceivedFromApi(): void
    {
        
        //ARRANGE
        $expectedResponseArray = [
            "icon_url" => "https://assets.chucknorris.host/img/avatar/chuck-norris.png",
            "id" => "suimhigvR5CAK-c-VANfPQ",
            "url" => "",
            "value" => "Chuck Norris doesn't buy wine. He just stares at a bottle of Welches Grape Juice and it turns into 1945 Chateau Mouton Rothschild out of fear."
        ];

        $expectedResponseJson = json_encode($expectedResponseArray);

        Http::fake([
            'api.chucknorris.io/jokes/random' => Http::response($expectedResponseJson, 200),
        ]);

        //ACT
        $response = $this->get('/api/chuck-norris');

        //ASSERT
        $this->assertDatabaseHas('jokes', ['joke' => $expectedResponseArray['value']]);

        $response->assertJson([
            'message' => 'Chuck Norris joke received.'
        ]);
    } 

    
}

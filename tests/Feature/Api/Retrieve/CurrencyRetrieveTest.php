<?php

namespace Tests\Feature\Api\Retrieve;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\UserToken;

class CurrencyRetrieveTestTest extends TestCase
{

    use UserToken;

    public function testGetAllSuccessful()
    {
        $response = $this->json('GET', '/api/currencies', [], $this->getHeaders());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'code', 'short_name'],
        ]);
    }

    public function testGetAllWithRatesSuccessful()
    {
        $response = $this->json('GET', '/api/currencies?withRates=true', [], $this->getHeaders());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'code', 'short_name', 'mult', 'rate'],
        ]);
    }


}


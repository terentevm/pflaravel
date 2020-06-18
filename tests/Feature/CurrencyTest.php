<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CurrencyTest extends TestCase
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

    public function testCreateSuccessfully()
    {
        $data = [
            'code' => 203,
            'name' => 'Чешская крона',
            'short_name' => 'CZK'
        ];

        $token = $this->getToken();

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $token"
        ];

        $response = $this->json('POST', '/api/currencies', $data, $headers);
        $response->assertStatus(201);

    }

}

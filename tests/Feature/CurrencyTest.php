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

    public function testCreateSuccessfull()
    {
        $data = [
            'code' => 203,
            'name' => 'Чешская крона',
            'short_name' => 'CZK'
        ];

        $response = $this->json('POST', '/api/currencies', $data, $this->getHeaders());
        $response->assertStatus(201);

    }

}

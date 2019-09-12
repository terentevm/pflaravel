<?php

namespace Tests\Feature\Api\Retrieve;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\UserToken;
use Illuminate\Http\JsonResponse;

class WalletRetrieveTest extends TestCase
{

    use UserToken;

    public function testGetAllSuccessful()
    {
        $response = $this->json('GET', '/api/wallets', [], $this->getHeaders());
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'currency', 'is_creditcard', 'grace_period', 'credit_limit'],
        ]);
    }

    public function testGetWithBalanceSuccessful()
    {
        $headers = $this->getHeaders();
        $response = $this->json('GET', '/api/wallets', [], $headers);
        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => ['id', 'name', 'currency', 'is_creditcard', 'grace_period', 'credit_limit'],
        ]);

        $data = $response->getData(true);

        foreach ($data as $wallet) {

            $url = "/api/wallets/{$wallet['id']}?withbalance=true";

            $response = $this->json('GET', $url, [], $headers);

            $response->assertStatus(200);

            $response->assertJsonStructure([
                'id',
                'name',
                'currency',
                'is_creditcard',
                'grace_period',
                'credit_limit',
                'balance'

            ]);
        }
    }


}


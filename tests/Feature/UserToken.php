<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 02.08.2019
 * Time: 17:48
 */

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;

trait UserToken
{
    public function getToken()
    {
        $token = '';

        if (Auth::attempt(['login' => 'mick911@mail.ru', 'password' => '346103'])) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;

        }

        return $token;
    }

    public function getHeaders()
    {
        $token = $this->getToken();

        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => "Bearer $token"
        ];
    }
}
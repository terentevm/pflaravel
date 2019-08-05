<?php

namespace App\Http\Controllers;

use App\Facades\UUID;
use Illuminate\Http\Request;
use App\Http\Requests\UserSignup;
use App\User;
use App\Currency;
use App\Settings;
use App\Rates;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $successStatus = 200;

    public function signup(UserSignup $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['id'] = UUID::gen();

        DB::transaction(function () use ($input) {
            $user = User::create($input);
            $sysCurrency = Currency::getSystemCurrency($input);
            $sysCurrency['user_id'] = $user->id;
            $sysCurrency['id'] = UUID::gen();

            $currency = Currency::Create($sysCurrency);

            Settings::create([
                'user_id' => $user->id,
                'currency_id' => $currency->id
            ]);

            Rates::create([
                'user_id' => $user->id,
                'currency_id' => $currency->id,
                'date' => '1980-01-01',
                'rate' => 1,
                'mult' => 1
            ]);
        });

        return response('OK', 201);
    }

    public function login()
    {
        if (Auth::attempt(['login' => request('login'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;

            $settings = Settings::with('currency')->with('wallet')->with('reportcurrency')->first();
            $success['settings'] = $settings;

            return response()->json($success, $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function details()
    {

    }
}

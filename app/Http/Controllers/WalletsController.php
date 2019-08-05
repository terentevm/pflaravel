<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Http\Resources\WalletResource;
use App\Http\Resources\WalletResourceCollection;
use App\Wallet;

class WalletsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = Wallet::with('currency')->get();

        $wallets->transform(function (Wallet $wallet) {
            return new WalletResource($wallet);
        });

        return new WalletResourceCollection($wallets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalletRequest $request)
    {
        $wallet = Wallet::create($request->all());

        return response()->json([
            'id' => $wallet->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new WalletResource(Wallet::with('currency')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(WalletRequest $request, $id)
    {
        $wallet = Wallet::findOrFail($id);

        $wallet->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Wallet::destroy($id);
    }
}

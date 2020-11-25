<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Http\Resources\WalletResource;
use App\Http\Resources\WalletResourceCollection;
use App\Repositories\BalanceRepository;
use App\Wallet;
use Illuminate\Http\Request;

class WalletsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\WalletResourceCollection
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
     * @param  \App\Http\Requests\WalletRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalletRequest $request)
    {
        if ($request->user()->cant('createCheckRowLimit', \App\ModelByUser::class)) {
            abort(403, "Rows limit exceeded for user!");
        }

        $wallet = Wallet::create($request->except('balance'));

        return response()->json([
            'id' => $wallet->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, string $id)
    {

        $wallet = Wallet::with('currency')->findOrFail($id);

        $transactions = \App\RegMoneyTransaction::where('wallet_id', $wallet->id)->limit(1)->get();

        $wallet->block_currency = $transactions->count() > 0;

        if ($request->input('withbalance') === 'true') {

            $wallet = (new BalanceRepository())->getWalletWithBalance($wallet);

        }

        return new WalletResource($wallet);
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

        $wallet->update($request->except('balance'));
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

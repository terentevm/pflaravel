<?php

namespace App\Http\Controllers;

use App\Events\TransferCreate;
use App\Events\TransferUpdate;
use App\Http\Resources\TransferResource;
use App\Jobs\Documents\Transfer\CreateTransfer;
use App\Jobs\Documents\Transfer\UpdateTransfer;
use App\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Transfer::with(['walletFrom', 'walletTo'])->filter($request)->orderBy('date',
            'desc')->paginate(15);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cant('createCheckRowLimit', \App\ModelByUser::class)) {
            abort(403, "Rows limit exceeded for user!");
        }

        $transfer = $this->dispatch(
            new CreateTransfer(
                Auth::user(),
                $request->only([
                    'id',
                    'date',
                    'wallet_id_from',
                    'wallet_id_to',
                    'sum_from',
                    'sum_to',
                    'comment'
                ])
            )
        );

        return response()->json([
            'id' => $transfer->id
        ])->setStatusCode(201);
    }


    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \App\Http\Resources\TransferResource
     */
    public function show(string $id)
    {

        return new TransferResource(Transfer::with(['walletFrom', 'walletTo'])->findOrFail($id));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {

        $this->dispatch(
            new UpdateTransfer(
                $transfer,
                $request->only([
                    'id',
                    'date',
                    'wallet_id_from',
                    'wallet_id_to',
                    'sum_from',
                    'sum_to',
                    'comment'
                ])
            )
        );

        return response("OK", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $count = Transfer::destroy($id);
        return $count > 0 ? response('DELETED', 200) : response('NOT DELETED', 500);
    }
}

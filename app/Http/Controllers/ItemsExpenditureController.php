<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemsExpenditureRequest;
use App\Http\Resources\ItemExpenditureResource;
use App\ItemExpenditure;
use Illuminate\Http\Request;

class ItemsExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $with_nested = $request->input('withnested') === "true" ? true : false;
        $parent_id = $request->input('parent') ?? null;

        $items = ItemExpenditure::findByParent($parent_id, $with_nested);

        return ItemExpenditureResource::collection($items);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemsExpenditureRequest $request)
    {
        $item = ItemExpenditure::create($request->all());

        return response()->json([
            'id' => $item->id
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
        $item = ItemExpenditure::with('parent')->findOrFail($id);

        return new ItemExpenditureResource($item);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemsExpenditureRequest $request, $id)
    {
        $item = ItemExpenditure::findOrFail($id);

        $item->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ItemExpenditure::destroy($id);
    }
}

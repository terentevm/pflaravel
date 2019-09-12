<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemsIncomeRequest;
use App\Http\Resources\ItemExpenditureResource;
use App\ItemIncome;

class ItemsIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $asList = $request->input('list') === "true" ? true : false;

        if ($asList === true) {
            $items = ItemIncome::query()->filter($request)->orderBy('name', 'asc')->get();

        } else {

            $with_nested = $request->input('withnested') === "true" ? true : false;

            $parent_id = $request->input('parent') ?? null;

            $items = ItemIncome::findByParent($parent_id, $with_nested);
        }

        return ItemExpenditureResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ItemsIncomeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemsIncomeRequest $request)
    {
        $item = ItemIncome::create($request->all());

        return response()->json([
            'id' => $item->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \App\Http\Resources\ItemExpenditureResource
     */
    public function show($id)
    {
        $item = ItemIncome::with('parent')->findOrFail($id);

        return new ItemExpenditureResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = ItemIncome::findOrFail($id);

        $formData = $request->all();

        if (!isset($formData['parent_id'])) {
            $formData['parent_id'] = null;
        }

        $item->update($formData);

        return response('',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ItemIncome::destroy($id);
    }
}

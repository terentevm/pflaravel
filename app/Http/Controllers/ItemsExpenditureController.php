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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $asList = $request->input('list') === "true" ? true : false;

        if ($asList === true) {
            $items = ItemExpenditure::query()->filter($request)->orderBy('name', 'asc')->get();

        } else {

            $with_nested = $request->input('withnested') === "true" ? true : false;

            $parent_id = $request->input('parent') ?? null;

            $items = ItemExpenditure::findByParent($parent_id, $with_nested);
        }

        return ItemExpenditureResource::collection($items);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ItemsExpenditureRequest $request
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
     * @return \App\Http\Resources\ItemExpenditureResource
     */
    public function show($id)
    {
        $item = ItemExpenditure::with('parent')->findOrFail($id);

        return new ItemExpenditureResource($item);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ItemsExpenditureRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemsExpenditureRequest $request, $id)
    {
        $item = ItemExpenditure::findOrFail($id);

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
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ItemExpenditure::destroy($id);
    }
}

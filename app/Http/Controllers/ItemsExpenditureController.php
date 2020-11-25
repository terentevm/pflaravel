<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemsExpenditureRequest;
use App\Http\Resources\ItemExpenditureResource;
use App\ItemExpenditure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (!Auth::user()->can('createCheckRowLimit', \App\ModelByUser::class)) {
            abort(403, "Rows limit exceeded for user!");
        }

        $item = ItemExpenditure::create($request->all());

        return response()->json([
            'id' => $item->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \App\Http\Resources\ItemExpenditureResource
     */
    public function show(string $id)
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
    public function update(ItemsExpenditureRequest $request, string $id)
    {
        $item = ItemExpenditure::findOrFail($id);

        $formData = $request->all();

        if (!isset($formData['parent_id'])) {
            $formData['parent_id'] = null;
        }

        $item->update($formData);

        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        return ItemExpenditure::destroy($id) > 0 ? response('DELETED', 200) : response('NOT DELETED', 500);
    }
}

<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactResource;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return response(ContactResource::collection(Contact::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        if ($request->user()->cant('createCheckRowLimit', \App\ModelByUser::class)) {
            abort(403, "Rows limit exceeded for user!");
        }

        $contact = Contact::create($request->only(['id', 'name', 'phone', 'email']));

        return response()->json([
            'id' => $contact->id
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(new ContactResource(Contact::findOrFail($id)));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ContactUpdateRequest $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, string $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->update($request->only(['name', 'phone', 'email']));

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
        $count = Contact::destroy($id);
        return $count > 0 ? response('DELETED', 200) : response('NOT DELETED', 500);
    }
}

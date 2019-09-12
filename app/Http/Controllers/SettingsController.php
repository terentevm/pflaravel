<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Http\Resources\SettingsResource;
use App\Settings;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\SettingsResource
     */
    public function index()
    {
        $settings = Settings::with(['currency', 'wallet', 'reportcurrency'])->findOrFail(Auth::user()->id);

        return new SettingsResource($settings);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsRequest $request)
    {
        $settings = Settings::findOrFail(Auth::user()->id);

        $settings->update($request->only(['wallet_id', 'report_currency']));

        return response('',200);

    }

}

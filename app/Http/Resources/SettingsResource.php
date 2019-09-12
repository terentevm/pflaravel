<?php

namespace App\Http\Resources;

use App\Wallet;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'currency_id' =>$this->currency_id,
            'wallet_id' => $this->wallet_id,
            'report_currency' => $this->report_currency,
            'currency' => $this->currency,
            'wallet' => is_null($this->wallet_id) ? null : new WalletResource($this->wallet),
            'reportcurrency' => $this->reportcurrency
        ];
    }
}

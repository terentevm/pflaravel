<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'currency' => $this->currency,
            'is_creditcard' => $this->is_creditcard,
            'grace_period' => $this->grace_period,
            'credit_limit' => $this->credit_limit,
            'block_currency' => $this->block_currency
        ];

        if ($request->input('withbalance') === 'true') {
            $data['balance'] = $this->balance;
        }

        return $data;
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransferResource extends JsonResource
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
            'id' => $this->id,
            'date' => $this->date,
            'walletFrom' => new WalletResource($this->walletFrom),
            'walletTo' => new WalletResource($this->walletTo),
            'sumFrom' => floatval($this->sum_from),
            'sumTo' => floatval($this->sum_to)
        ];
    }
}

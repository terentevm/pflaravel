<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\IncomeRow;

class IncomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'date' => $this->date,
            'wallet' => $this->wallet,
            'currency' => $this->wallet->currency,
            'sum' => floatval($this->sum),
            'comment' => is_null($this->comment) ? '' : trim($this->comment),
            'rows' => IncomeRowResource::collection(IncomeRow::with('item')->where('doc_id', $this->id)->orderBy('id')->get())
        ];

        return $data;
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncomeRowResource extends JsonResource
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
            'doc_id' => $this->doc_id,
            'item' => $this->item,
            'sum' => floatval($this->sum),
            'comment' =>is_null($this->comment) ? '' : trim($this->comment)
        ];
    }
}

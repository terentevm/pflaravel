<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $arrData = [
            'id' => $this->id,
            'name' => trim($this->name),
            'code' => $this->code,
            'short_name' => $this->short_name
        ];

        if (isset($this->rate)) {
            $arrData['rate'] = $this->rate;
        }

        if (isset($this->mult)) {
            $arrData['mult'] = $this->mult;
        }

        return $arrData;
    }
}

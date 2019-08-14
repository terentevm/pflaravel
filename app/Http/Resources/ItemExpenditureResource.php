<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemExpenditureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'active' => boolval($this->active),
            'comment' => $this->comment ?? '',
            'hasChilds' => empty($this->items),
            'items' => empty($this->items) ? [] : ItemExpenditureResource::collection($this->items)
        ];
    }
}

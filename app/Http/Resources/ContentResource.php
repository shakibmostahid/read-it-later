<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
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
            'url' => $this->url,
            'pocket_id' => $this->pocket_id,
            'created_at' => $this->created_at->format('d-m-Y H:i:s (T)'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s (T)')
        ];
    }
}

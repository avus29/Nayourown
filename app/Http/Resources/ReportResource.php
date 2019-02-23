<?php

namespace Nayourown\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            // 'category_id' => $this->category->id,
            'category' => $this->category->name,
            'description' => $this->description,
            'reported_on' => $this->created_at,
            'url' => "/reports/{$this->category->slug}/{$this->id}",
        ];
    }

    public function with($request){
        return [
            'claims' => $this->claims,
        ];
    }
}

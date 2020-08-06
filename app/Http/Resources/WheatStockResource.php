<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WheatStockResource extends JsonResource
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
            'id'                    =>      $this->id,
            'profile_id'            =>      $this->profile_id,
            'name'                  =>      $this->profile->name,
            'sacks'                 =>      $this->num_of_sack,
            'weight'                =>      $this->weight_per_sack,
            'price'                 =>      $this->price,
            'commission'            =>      $this->commission,
            'category'              =>      $this->category,
            'created_at'            =>      $this->created_at,
            'updated_at'            =>      $this->updated_at
        ];
    }
}

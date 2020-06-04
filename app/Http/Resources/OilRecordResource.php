<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OilRecordResource extends JsonResource
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
            'id'                        =>      $this->id,
            'quantity'                  =>      $this->quantity,
            'price_per_litre'           =>      $this->price_per_litre,
            'paid_per_litre'            =>      $this->paid_per_litre,
            'user'                      =>      $this->user->profile->name,
            'filling_station'           =>      $this->fillingStation->name,
            'profile'                   =>      $this->profile->name,
            'status'                    =>      $this->status,
            'created_at'                =>      $this->created_at,
            'updated_at'                =>      $this->updated_at
        ];
    }
}

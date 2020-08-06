<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FertilizerStockResource extends JsonResource
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
            'fertilizer_trader_id'  =>      $this->fertilizer_trader_id,
            'trader'                =>      $this->fertilizerTrader->name,
            'quantity'              =>      $this->quantity,
            'price'                 =>      $this->price,
            'type'                  =>      $this->type,
            'weight'                =>      $this->weight,
            'created_at'            =>      $this->created_at,
            'updated_at'            =>      $this->updated_at
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicineStockResource extends JsonResource
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
            'medicine_trader_id'        =>      $this->medicine_trader_id,
            'trader'                    =>      $this->medicineTrader->name,
            'quantity'                  =>      $this->quantity,
            'price'                     =>      $this->price,
            'type'                      =>      $this->type,
            'medicine_name'             =>      $this->medicineType->name,
            'created_at'                =>      $this->created_at,
            'updated_at'                =>      $this->updated_at
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OilCompanyResource extends JsonResource
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
            'id'                =>      $this->id,
            'avatar'            =>      asset("images/logos/$this->avatar"),
            'name'              =>      $this->name,
            'phone_number'      =>      $this->phone_number,
            'address'           =>      $this->address,
            'created_at'        =>      $this->created_at,
            'updated_at'        =>      $this->updated_at
        ];
    }
}

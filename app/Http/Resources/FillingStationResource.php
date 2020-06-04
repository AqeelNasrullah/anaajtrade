<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FillingStationResource extends JsonResource
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
            'id'                                =>      $this->id,
            'company_avatar'                    =>      asset("images/logos/".$this->oilCompany->avatar),
            'name'                              =>      $this->name,
            'phone_number'                      =>      $this->phone_number,
            'address'                           =>      $this->address,
            'company_name'                      =>      $this->oilCompany->name,
            'company_phone_number'              =>      $this->oilCompany->phone_number,
            'company_address'                   =>      $this->oilCompany->address,
            'created_at'                        =>      $this->created_at,
            'updated_at'                        =>      $this->updated_at
        ];
    }
}

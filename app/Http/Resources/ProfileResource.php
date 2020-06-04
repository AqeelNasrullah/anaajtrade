<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'avatar'                            =>      asset("images/dps/$this->avatar"),
            'name'                              =>      $this->name,
            'father_name'                       =>      $this->father_name,
            'phone_number'                      =>      $this->phone_number,
            'cnic'                              =>      $this->cnic,
            'address'                           =>      $this->address,
            'property'                          =>      $this->property . ' Acres',
            'role'                              =>      $this->role->name,
            'created_at'                        =>      $this->created_at,
            'updated_at'                        =>      $this->updated_at
        ];
    }
}

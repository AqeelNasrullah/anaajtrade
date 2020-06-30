<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'                  =>      $this->profile->name,
            'father_name'           =>      $this->profile->father_name,
            'phone_number'          =>      $this->phone_number,
            'cnic'                  =>      $this->profile->cnic,
            'address'               =>      $this->profile->address,
            'property'              =>      $this->profile->property,
            'role'                  =>      $this->profile->role->name
        ];
    }
}

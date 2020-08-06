<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OtherRecordResource extends JsonResource
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
            'profile_id'        =>      $this->profile_id,
            'name'              =>      $this->profile->name,
            'description'       =>      $this->description,
            'amount'            =>      $this->amount,
            'created_at'        =>      $this->created_at,
            'updated'           =>      $this->updated_at
        ];
    }
}

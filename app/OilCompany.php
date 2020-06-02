<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OilCompany extends Model
{
    // Fillable Properties
    protected $fillable = [
        'avatar', 'name', 'phone_number', 'address'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Oil company has many filling stations
    public function FillingStations()
    {
        return $this->hasMany(FillingStation::class);
    }
}

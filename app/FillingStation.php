<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FillingStation extends Model
{
    // Fillable Properties
    protected $fillable = [
        'name', 'phone_number', 'address', 'oil_company_id'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Filling station belongs to oil company
    public function oilCompany()
    {
        return $this->belongsTo(OilCompany::class);
    }

    // Filling station has many oil records
    public function oilRecords()
    {
        return $this->hasMany(OilRecord::class);
    }

    // Filling station belongs to many users
    public function manyUsers()
    {
        return $this->belongsToMany(User::class);
    }
}

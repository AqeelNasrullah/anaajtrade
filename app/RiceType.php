<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiceType extends Model
{
    // Fillable Properties
    protected $fillable = [
        'name'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Rice type has many rice stocks
    public function riceStocks()
    {
        return $this->hasMany(RiceStock::class);
    }

    // Rice type has many rice records
    public function riceRecords()
    {
        return $this->hasMany(RiceRecord::class);
    }
}

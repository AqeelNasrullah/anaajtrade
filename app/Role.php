<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Role has many profiles
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}

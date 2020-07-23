<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicineRecord extends Model
{
    // Fillable Properties
    protected $fillable = [
        'quantity', 'type', 'price', 'paid', 'medicine_type_id', 'user_id', 'profile_id', 'status'
    ];

    /**
     * Database Relations
     */

    // Medicine record belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Medicine record belongs to profile
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    // Medicine record belongs to medicine type
    public function medicineType()
    {
        return $this->belongsTo(MedicineType::class);
    }
}

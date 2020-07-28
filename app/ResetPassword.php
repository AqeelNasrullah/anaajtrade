<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    // Fillable properties
    protected $fillable = [
        'phone_number', 'code', 'code_expiry', 'param', 'param_expiry'
    ];
}

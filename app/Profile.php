<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // Fillable Properties
    protected $fillable = [
        'avatar', 'name', 'father_name', 'phone_number', 'cnic', 'address', 'property', 'role_id'
    ];

    /**
     * Database Relations
     *
     * @return Model filled with data
     */

    // Profile belongs to Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Profile has one user
    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Profile belongs to many users
    public function manyUsers()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // Profile has many account books
    public function accountBooks()
    {
        return $this->hasMany(AccountBook::class);
    }

    // Profile has many oil records
    public function oilRecords()
    {
        return $this->hasMany(OilRecord::class);
    }

    // Profile has many wheat stocks
    public function wheatStocks()
    {
        return $this->hasMany(WheatStock::class);
    }

    // Profile has many wheats records
    public function wheatRecords()
    {
        return $this->hasMany(WheatRecord::class);
    }

    // Profile has many rice stocks
    public function riceStocks()
    {
        return $this->hasMany(RiceStock::class);
    }

    // Profile has many rice records
    public function riceRecords()
    {
        return $this->hasMany(RiceRecord::class);
    }

    // Profile has many others
    public function others()
    {
        return $this->hasMany(Other::class);
    }
}

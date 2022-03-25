<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    /**
     * get details about all users that have citizenship of this country
     *
     * @return UserDetails
     */
    public function userDetails(): UserDetails
    {
        return $this->hasMany(UserDetails::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'country_id',
        'first_name',
        'last_name',
        'phone_number',
    ];

    /**
     * Get the active user that has this details
     */
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the country citizenship of the user that has this details
     *
     * @return Country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'active',
    ];

    public function userDetails()
    {
        return $this->hasOne(UserDetails::class);
    }

    /**
     * @return bool
     */
    public function hasDetails(): bool
    {
        return count($this->userDetails()->get()) > 0;
    }

}

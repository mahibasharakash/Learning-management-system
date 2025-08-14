<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'image',
        'name',
        'email',
        'password',
        'date_of_birth',
        'mobile_number',
        'address',
        'reset_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $dates = ['date_of_birth'];

    protected $appends = ['date_of_birth_formatted'];

    public function getDateOfBirthFormattedAttribute()
    {
        if (!$this->date_of_birth) {
            return null;
        }

        if ($this->date_of_birth instanceof \Carbon\Carbon) {
            return $this->date_of_birth->format('d F Y');
        }

        return \Carbon\Carbon::parse($this->date_of_birth)->format('d F Y');
    }

}

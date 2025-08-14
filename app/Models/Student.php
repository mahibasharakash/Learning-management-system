<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'image',
        'name',
        'email',
        'password',
        'registration_date',
        'roll_id',
        'course',
        'gender',
        'reset_code',
        'mobile_number',
        'blood_group',
        'date_of_birth',
        'parent_name',
        'parent_mobile_number',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'date_of_birth' => 'date',
    ];

    protected $dates = ['date_of_birth','registration_date'];

    protected $appends = ['date_of_birth_formatted', 'registration_date_formatted'];

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

    public function getRegistrationDateFormattedAttribute()
    {
        if (!$this->registration_date) {
            return null;
        }

        if ($this->registration_date instanceof \Carbon\Carbon) {
            return $this->registration_date->format('d F Y');
        }

        return \Carbon\Carbon::parse($this->registration_date)->format('d F Y');
    }

}

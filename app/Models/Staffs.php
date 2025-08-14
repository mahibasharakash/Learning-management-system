<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staffs extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'image',
        'name',
        'joining_date',
        'email',
        'password',
        'mobile_number',
        'gender',
        'designation',
        'department',
        'date_of_birth',
        'reset_code',
        'educational_qualification',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $dates = ['date_of_birth','joining_date'];

    protected $appends = ['date_of_birth_formatted','joining_date_formatted'];

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

    public function getJoiningDateFormattedAttribute()
    {
        if (!$this->joining_date) {
            return null;
        }

        if ($this->joining_date instanceof \Carbon\Carbon) {
            return $this->joining_date->format('d F Y');
        }

        return \Carbon\Carbon::parse($this->joining_date)->format('d F Y');
    }

}

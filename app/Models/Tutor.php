<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class Tutor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile_number',
        'image',
        'gender',
        'department',
        'designation',
        'joining_date',
        'date_of_birth',
        'educational_qualification',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'joining_date' => 'date',
        'date_of_birth' => 'date',
    ];

    protected $appends = [
        'joining_date_formatted',
        'date_of_birth_formatted'
    ];

    public function getDateOfBirthFormattedAttribute()
    {
        return $this->date_of_birth
            ? Carbon::parse($this->date_of_birth)->format('d F Y')
            : null;
    }

    public function getJoiningDateFormattedAttribute()
    {
        return $this->joining_date
            ? Carbon::parse($this->joining_date)->format('d F Y')
            : null;
    }
}

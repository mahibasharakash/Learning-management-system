<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_name',
        'head_of_department',
        'start_date',
        'department_details',
    ];

    protected $dates = ['start_date'];

    protected $appends = ['start_date_formatted'];

    public function getStartDateFormattedAttribute()
    {
        if (!$this->start_date) {
            return null;
        }

        if ($this->start_date instanceof \Carbon\Carbon) {
            return $this->start_date->format('d F Y');
        }

        return \Carbon\Carbon::parse($this->start_date)->format('d F Y');
    }

}

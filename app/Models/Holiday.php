<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'start_date',
        'end_date',
        'details',
    ];

    protected $dates = ['start_date', 'end_date'];

    protected $appends = ['start_date_formatted', 'end_date_formatted'];

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

    public function getEndDateFormattedAttribute()
    {
        if (!$this->end_date) {
            return null;
        }

        if ($this->end_date instanceof \Carbon\Carbon) {
            return $this->end_date->format('d F Y');
        }

        return \Carbon\Carbon::parse($this->end_date)->format('d F Y');
    }

}

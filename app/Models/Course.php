<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'code',
        'course_details',
        'from_start',
        'course_duration',
        'price',
        'tutor',
        'maximum_students',
    ];

    public function tutor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tutor::class, 'tutor', 'id');
    }

    protected $dates = ['from_start'];

    protected $appends = ['from_start_formatted'];

    public function getFromStartFormattedAttribute(): ?string
    {
        if (!$this->from_start) {
            return null;
        }

        if ($this->from_start instanceof \Carbon\Carbon) {
            return $this->from_start->format('d F Y');
        }

        return \Carbon\Carbon::parse($this->from_start)->format('d F Y');
    }

}

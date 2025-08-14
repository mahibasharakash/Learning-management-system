<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'date', 'color'];

    protected $casts = [
        'date' => 'datetime',
    ];

    protected $appends = ['formatted_date'];

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)
            ->setTimezone('UTC') // or your timezone
            ->format('F j, Y g:i A');
    }

}

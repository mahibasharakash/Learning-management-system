<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Fees extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'student',
        'department',
        'fees_type',
        'payment_type',
        'status',
        'amount',
        'payment_details',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->invoice_no)) {
                $latestId = static::max('id') + 1;
                $model->invoice_no = '#' . str_pad($latestId, 6, '0', STR_PAD_LEFT);
            }
        });
    }

    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Student::class, 'student', 'id');
    }

    public function department(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Department::class, 'department', 'id');
    }

    protected $dates = ['updated_at'];

    protected $appends = ['updated_at_formatted'];

    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at
            ? ($this->updated_at instanceof Carbon
                ? $this->updated_at->format('d F Y')
                : Carbon::parse($this->updated_at)->format('d F Y'))
            : null;
    }
}

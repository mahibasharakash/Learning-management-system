<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryAssets extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject',
        'author_name',
        'publish_date',
        'department',
        'asset_type',
        'purchase_date',
        'price',
        'status',
        'asset_details',
    ];

    protected $dates = ['publish_date','purchase_date'];

    protected $appends = ['publish_date_formatted', 'purchase_date_formatted'];

    public function getPublishDateFormattedAttribute()
    {
        if (!$this->publish_date) {
            return null;
        }

        if ($this->publish_date instanceof \Carbon\Carbon) {
            return $this->publish_date->format('d F Y');
        }

        return \Carbon\Carbon::parse($this->publish_date)->format('d F Y');
    }

    public function getPurchaseDateFormattedAttribute()
    {
        if (!$this->purchase_date) {
            return null;
        }

        if ($this->purchase_date instanceof \Carbon\Carbon) {
            return $this->purchase_date->format('d F Y');
        }

        return \Carbon\Carbon::parse($this->purchase_date)->format('d F Y');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'end',
        'country_id',
        'city_id',
        'address',
        'latitude',
        'longitude',
        'featured_image',
        'description'
    ];

    protected $appends = [
        'date_start',
        'date_end'
    ];

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function getDateStartAttribute(): string
    {
        return Carbon::parse($this->start)->format('Y-m-d\TH:i');
    }

    public function getDateEndAttribute(): string
    {
        return Carbon::parse($this->end)->format('Y-m-d\TH:i');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
	protected $fillable = [
        'name',
        'phone',
        'address',
        'image',
        'max_future_days',
        'slot_duration',
    ];

    protected $casts = [
        'name' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'image' => 'string',
        'max_future_days' => 'integer',
        'slot_duration' => 'integer',
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function slots(): HasMany
    {
        return $this->hasMany(Slot::class);
    }
}

<?php

namespace App\Models;

use App\Casts\TimeCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slot extends Model
{
    use SoftDeletes;

    protected $fillable = ['business_id', 'slot_date', 'start_time', 'end_time'];

    protected $casts = [
        'slot_date' => 'date',
        'start_time' => TimeCast::class,
        'end_time' => TimeCast::class,
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function Booking(): HasOne
    {
        return $this->hasOne(Booking::class);
    }

    public function canBeBooked(): bool
    {
        return $this->slot_date->isFuture() && !$this->isBooked();
    }

    public function isBooked(): bool
    {
        return !is_null($this->Booking);
    }

    public function isMyBooking(): bool
    {
        return $this->Booking?->isMyBooking(auth()->user() ?? false);
    }

    public function canCancelBook(): bool
    {
        return $this->isBooked() && $this->booking->canBeCancelledByUser(auth()->user());
    }
}

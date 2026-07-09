<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'floor_type', 'price_per_hour', 'photo', 'location'])]
class Court extends Model
{
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

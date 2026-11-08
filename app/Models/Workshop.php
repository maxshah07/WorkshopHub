<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable('category_id', 'title', 'description', 'starts_at', 'capacity')]
class Workshop extends Model
{
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
        ];
    }
}

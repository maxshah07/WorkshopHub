<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable('workshop_id', 'attendee_name', 'attendee_email')]
class Booking extends Model
{
    public function workshop() {
        return $this->belongsTo(Workshop::class);
    }
}

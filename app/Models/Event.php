<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        "type",
        "description",
        "date_start",
        "date_end",
        "price",
        "slots",
        "slots_left",
        "registered",
    ];

    protected $primaryKey = "id"; //custom primaryKey

    // public function getSlotsAttribute($value)
    // {
    //     return ($value - 'events.registered');
    // }
}

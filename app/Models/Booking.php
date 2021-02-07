<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

   protected  $touches = ['booking_room'];

    public function rooms(){
      return $this->belongsToMany(Room::class)->withPivot('check_in', 'check_out');
    }

    public function booking_status(){
      return $this->belongsTo(BookingStatus::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Api\ApiFilter;
use Illuminate\Database\Eloquent\Builder;
class Room extends Model
{
    use HasFactory,ApiFilter;



    public function room_type(){
      return $this->belongsTo(RoomType::class);
    }

    public function bookings(){
      return $this->belongsToMany(Booking::class)->withPivot('check_in', 'check_out');
    }


    public function scopeDateFilter($query){
      return $query->doesntHave("bookings")->orWhereHas("bookings" ,function (Builder $query) {
          $query->whereRaw("(check_in not between ? and ?) and (check_out not between ? and ?)" ,  array($this->date_from,$this->date_to,$this->date_from,$this->date_to));
      });
    }

    public function scopeRoomTypeFilter($query){
      return $query->where("room_type_id", $this->room_type_id);
    }





}

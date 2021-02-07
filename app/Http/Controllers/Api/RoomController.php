<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Room;

class RoomController extends Controller
{


    public function fetch(){
      $room = new Room;
      $room->resolveApiFilter();
      $active_filters = $room->get_active_filters();
      $av_rooms = $room;

      foreach ($active_filters as $scope=>$filter) {
        if(method_exists($room, $scope)){
          $av_rooms = $av_rooms->{$filter}();
        }
      }

      $av_rooms = $av_rooms->get();

      return response()->json($av_rooms, 200);
    }
}

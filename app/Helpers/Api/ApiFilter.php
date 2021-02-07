<?php

namespace App\Helpers\Api;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Events\RouteMatched;

trait ApiFilter{

  private $date_from;
  private $date_to;
  private $room_type_id;
  private $active_filters;

  public function resolveApiFilter(){

        $this->active_filters = array();
        if(request()->has('filter')){
          $filters = request()->filter;

          foreach ($filters as $filter => $value) {
            switch ($filter){
              case "dates":
                $this->active_filters["scopeDateFilter"]="dateFilter";
                $date_str = substr($value,1);
                $date_str = substr($date_str,0,-1);
                $date_arr = explode(',',$date_str);
                $this->date_from =  \Carbon\Carbon::createFromFormat('d/m/Y',$date_arr[0]);
                $this->date_to   =  \Carbon\Carbon::createFromFormat('d/m/Y',$date_arr[1]);
              break;
              case "room_type":
                $this->active_filters["scopeRoomTypeFilter"]="roomTypeFilter";
                $this->room_type_id = $value;
              break;
              default:
              break;
            }
          }
        }
  }

  public function get_active_filters(){
    return $this->active_filters;
  }

}

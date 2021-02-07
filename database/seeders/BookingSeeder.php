<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $begin = \Carbon\Carbon::now();
      $booking_status_arr = DB::table('booking_status')->get(['id']);
      $next_in_step = 1;
      $start_over   = 1;
      $room_counter = 0;
      $room_arr = DB::table('rooms')->get(['id'])->pluck('id');

      for($i=0; $i<180; $i++){
        $in = $begin;
        $out = clone $in;
        $out->addDays(rand(1,10));

        $booking_id = DB::table('bookings')->insertGetId([
            'booking_status_id' => $booking_status_arr[array_rand($booking_status_arr->toArray())]->id,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        DB::table('booking_room')->insert([
          'booking_id'=> $booking_id,
          'room_id'   => $room_arr[$room_counter],
          'check_in'  => $in,
          'check_out' => $out,

        ]);

        $room_counter++;
        if($room_counter == count($room_arr)-1){
          $room_counter = 0;
          $add_days = $start_over*11;
          $begin = \Carbon\Carbon::now()->addDays($add_days);
          $start_over++;
        }
        else{
          $begin->addDays($next_in_step);
        }
      }
    }
}

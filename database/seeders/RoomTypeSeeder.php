<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $room_type_arr = array('double','triple');

      foreach($room_type_arr as $type){
        DB::table('room_types')->insert([
            'lang' => $type,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
      }
    }
}

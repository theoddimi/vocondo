<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $room_type_data =  DB::table('room_types')->get(['id']);

        for($i=0; $i<80; $i++){
          DB::table('rooms')->insert([
              'lang' => 'Room-'.$i,
              'room_type_id' => $room_type_data[array_rand($room_type_data->toArray())]->id,
              'created_at'=>now(),
              'updated_at'=>now(),
          ]);
        }
    }
}

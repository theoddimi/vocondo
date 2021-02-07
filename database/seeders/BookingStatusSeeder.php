<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $status_arr = array('active','canceled','pending');

      foreach($status_arr as $status){
        DB::table('booking_status')->insert([
            'lang' => $status,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
      }
    }
}

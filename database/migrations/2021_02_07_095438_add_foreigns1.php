<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeigns1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       if (Schema::hasTable('rooms') && Schema::hasTable('room_types')) {
         Schema::table('rooms', function (Blueprint $table) {
             $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('restrict');
         });
       }

       if (Schema::hasTable('rooms') && Schema::hasTable('bookings')) {
         Schema::table('bookings', function (Blueprint $table) {
             $table->foreign('booking_status_id')->references('id')->on('booking_status')->onDelete('restrict');
         });
       }

       if (Schema::hasTable('rooms') && Schema::hasTable('bookings') && Schema::hasTable('booking_room')) {
         Schema::table('booking_room', function (Blueprint $table) {
             $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('restrict');
             $table->foreign('room_id')->references('id')->on('rooms')->onDelete('restrict');
         });
       }


     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       if (Schema::hasTable('rooms') && Schema::hasTable('room_types')) {
         Schema::table('rooms', function (Blueprint $table) {
             $table->dropForeign(['room_type_id']);
         });
       }

       if (Schema::hasTable('rooms') && Schema::hasTable('bookings')) {
         Schema::table('bookings', function (Blueprint $table) {
             $table->dropForeign(['booking_status_id']);
         });
       }

       if (Schema::hasTable('rooms') && Schema::hasTable('bookings') && Schema::hasTable('booking_room')) {
         Schema::table('booking_room', function (Blueprint $table) {
             $table->dropForeign(['booking_id']);
             $table->dropForeign(['room_id']);
         });
       }
     }
}

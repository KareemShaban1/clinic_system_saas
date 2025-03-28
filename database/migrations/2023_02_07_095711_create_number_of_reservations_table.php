<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('number_of_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->date('reservation_date');
            $table->integer('num_of_reservations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('number_of_reservations');
    }
};

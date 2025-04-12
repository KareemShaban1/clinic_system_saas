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
        Schema::create('reservation_service_fee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreignId('service_fee_id')->references('id')->on('service_fees')->onDelete('cascade');
            $table->decimal('fee', 10, 2);
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('reservation_service_fee');
    }
};

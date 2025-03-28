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
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->references('id')->on('reservations')->cascadOnDelete();
            $table->foreignId('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->string('name');
            $table->string('type');
            $table->string('dose');
            $table->string('frequency');
            $table->string('period');
            $table->string('notes')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('drugs');
    }
};

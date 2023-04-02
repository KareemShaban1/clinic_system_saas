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

            $table->string('drug_name');
            $table->string('drug_type');
            $table->string('drug_dose');
            $table->string('frequency');
            $table->string('period');
            $table->string('notes')->nullable();
            $table->foreignId('reservation_id')->references('reservation_id')->on('reservations')->cascadOnDelete();
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

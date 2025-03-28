<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glasses_distances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('reservation_id')->nullable()->constrained('reservations')->nullOnDelete();
            $table->foreignId('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->string('SPH_R_D')->nullable();
            $table->string('CYL_R_D')->nullable();
            $table->string('AX_R_D')->nullable();
            $table->string('SPH_L_D')->nullable();
            $table->string('CYL_L_D')->nullable();
            $table->string('AX_L_D')->nullable();

            $table->string('SPH_R_N')->nullable();
            $table->string('CYL_R_N')->nullable();
            $table->string('AX_R_N')->nullable();
            $table->string('SPH_L_N')->nullable();
            $table->string('CYL_L_N')->nullable();
            $table->string('AX_L_N')->nullable();

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
        Schema::dropIfExists('glasses_distances');
    }
};

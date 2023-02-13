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
        Schema::create('patients', function (Blueprint $table) {
            
            $table->id('patient_id');

            $table->string('name');

            $table->string('age')->nullable();

            $table->string('address');

            $table->string('email')->nullable();

            $table->char('phone', 20);

            $table->enum('blood_group',['A+','A-','B+','B-','O+','O-','AB+','AB-'])->nullable();

            $table->enum('gender',['male','female']);
            
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
        Schema::dropIfExists('patients');
    }
};

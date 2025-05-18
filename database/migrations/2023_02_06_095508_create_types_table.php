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
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type')->nullable();
             // Make the user morphable to any 'organization' model
             $table->nullableMorphs('organization'); 
             // (clinics , medical_laboratories , radiology_centers)    
            // Creates organization_id (unsignedBigInteger) and organization_type (string)

            
            // $table->foreignId('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            // Polymorphic relationship columns
            // $table->morphs('typeable'); // creates typeable_id and typeable_type
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
        Schema::dropIfExists('ray_types');
    }
};

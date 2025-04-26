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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->references('id')->on('clinics')->nullOnDelete();
            $table->string('name');
            $table->date('start_date');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->foreignId('governorate_id')
                ->nullable()->references('id')
                ->on('governorates')->nullOnDelete();
            $table->foreignId('city_id')
                ->nullable()->references('id')
                ->on('cities')->nullOnDelete();
            $table->foreignId('area_id')
                ->nullable()->references('id')
                ->on('areas')->nullOnDelete();
            $table->foreignId('speciality_id')
                ->nullable()->references('id')
                ->on('specialities')->nullOnDelete();
            $table->string('website')->nullable();
            $table->string('domain')->nullable();
            $table->string('database')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('clinics');
    }
};

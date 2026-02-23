<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('counties', function (Blueprint $table) {
            $table->id();
            $table->string('name',25);
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name',25);
            $table->foreignId('county_id')->constrained('counties','id')->onDelete('cascade');
        });

        Schema::create('postal_codes', function (Blueprint $table) {
                $table->id();
            $table->Integer('postal_code');
            $table->foreignId('city_id')->constrained('cities','id')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

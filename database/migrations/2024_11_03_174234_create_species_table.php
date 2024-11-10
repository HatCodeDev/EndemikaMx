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
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('scientific_name', 255); 
            $table->string('common_name', 255); 
            $table->text('description')->nullable(); 
            $table->string('conservation_status', 100); 
            $table->unsignedSmallInteger('average_lifespan')->nullable();
            $table->string('diet_type', 100);
            $table->unsignedBigInteger('population_estimate')->nullable(); 
            $table->text('threats')->nullable();
            $table->string('image', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};

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
        Schema::create('protected_areas', function (Blueprint $table) {
            $table->id();
            $table->string('area_name', 255); 
            $table->decimal('area_km2', 10, 2); 
            $table->date('established_date')->nullable(); 
            $table->string('protection_level', 100); 
            $table->foreignId('region_id')->constrained('regions')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protected_areas');
    }
};

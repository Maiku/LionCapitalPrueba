<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties');

            // 'sale' o 'rent'
            $table->string('type', 10);

            // 'open' o 'closed'
            $table->string('status', 10);

            $table->dateTime('operation_date_start')->nullable();
            $table->dateTime('operation_date_end')->nullable();

            // Una operación por propiedad y tipo (máx. una de venta y una de alquiler)
            $table->unique(['property_id', 'type']);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};

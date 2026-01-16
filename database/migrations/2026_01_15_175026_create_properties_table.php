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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->ulid('ulid')->unique();
            $table->string('intern_reference')->unique();
            $table->string('title');
            $table->string('street')->nullable();
            $table->string('number', 50)->nullable();
            $table->string('zip_code', 20)->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_sell')->default(false);
            $table->boolean('is_rent')->default(false);
            $table->decimal('sell_price', 15, 2)->nullable();
            $table->decimal('rental_price', 15, 2)->nullable();
            $table->decimal('built_m2', 15, 2)->nullable();
            $table->foreignId('office_id')->nullable()->constrained('offices');
            $table->foreignId('property_type_id')->nullable()->constrained('property_types');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('secondary_user_id')->nullable()->constrained('users');
            $table->foreignId('neighborhood_id')->nullable()->constrained('neighborhoods');
            $table->foreignId('district_id')->nullable()->constrained('districts');
            $table->foreignId('municipality_id')->nullable()->constrained('municipalities');
            $table->foreignId('region_id')->nullable()->constrained('regions');
            $table->foreignId('location_id')->nullable()->constrained('locations');
            $table->foreignId('zone_id')->nullable()->constrained('zones');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};

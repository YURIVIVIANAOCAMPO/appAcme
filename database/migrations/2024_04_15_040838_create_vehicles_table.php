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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate', 20)->unique();
            $table->string('color', 50);
            $table->string('brand', 100);
            $table->enum('vehicle_type', ['particular', 'público']);
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('set null');
            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('identification_number', 20)->unique();
            $table->string('first_name', 50);
            $table->string('second_name', 50)->nullable();
            $table->string('last_name', 100);
            $table->string('address', 255);
            $table->string('phone', 20);
            $table->string('city', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};

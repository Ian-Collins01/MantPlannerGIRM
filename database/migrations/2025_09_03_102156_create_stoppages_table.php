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
        Schema::create('stoppages', function (Blueprint $table) {
            $table->id();
            $table->text('reason');
            $table->dateTime('start_hour');
            $table->dateTime('end_hour')->nullable();
            $table->unsignedBigInteger('maintenance_id')->onDelete('cascade');;
            $table->foreign('maintenance_id')->references('id')->on('maintenances');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoppages');
    }
};

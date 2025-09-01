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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->dateTime('notice_hour')->nullable();
            $table->dateTime('start_hour')->nullable();
            $table->dateTime('lead_time')->nullable();
            $table->dateTime('end_hour')->nullable();
            $table->dateTime('stoppage_start')->nullable();
            $table->dateTime('stoppage_end')->nullable();
            $table->float('response_time')->nullable();
            $table->float('maintenance_time')->nullable();
            $table->text('description');
            $table->boolean('has_stoppage_machine');

            $table->unsignedBigInteger('machine_id');
            $table->foreign('machine_id')->references('id')->on('machines');
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->foreign('technician_id')->references('id')->on('users');
            $table->unsignedBigInteger('applicant_id')->nullable();
            $table->foreign('applicant_id')->references('id')->on('users');
            $table->unsignedBigInteger('maintenance_type');
            $table->foreign('maintenance_type')->references('id')->on('maintenance_types');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};

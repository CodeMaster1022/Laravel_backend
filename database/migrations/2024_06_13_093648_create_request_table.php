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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->integer('rider_id');
            $table->integer('driver_id');
            $table->float('cost')->default(0.0)->nullable();
            $table->string('start_location');
            $table->string('stop_location')->nullable();
            $table->string('end_location');
            $table->string('route_distance')->nullable();
            $table->timestamp('request_date')->nullable();
            $table->timestamp('arrived_date')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
    }
};

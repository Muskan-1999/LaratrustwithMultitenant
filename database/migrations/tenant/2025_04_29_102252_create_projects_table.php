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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('status', ['ongoing', 'cancelled'])->default('ongoing'); // Status can be ongoing or cancelled
            $table->decimal('total', 10, 2); // Total amount (you can adjust the precision and scale)
            $table->dateTime('start_date'); // Start date with time
            $table->dateTime('end_date'); // End date with time
            $table->boolean('open')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

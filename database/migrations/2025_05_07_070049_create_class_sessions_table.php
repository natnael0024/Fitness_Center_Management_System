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
        Schema::create('class_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_schedule_id')->constrained('class_schedules')->onDelete('cascade');
            $table->date('date');
            $table->enum('status',['scheduled','completed','cancelled'])->default('scheduled');
            $table->text('notes')->nullable(); // Trainer notes
            $table->timestamps();
        
            // $table->unique(['class_id', 'date', 'start_time']); // prevent duplicates
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_sessions');
    }
};
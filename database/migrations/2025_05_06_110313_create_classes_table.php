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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->boolean( 'is_premium')->nullable();
            $table->bigInteger('trainer_id')->nullable();
            $table->bigInteger( 'branch_id')->nullable();
            $table->integer( 'capacity')->nullable();
            $table->decimal( 'price',8,2)->nullable();
            $table->boolean( 'status')->default(true);
            $table->boolean('is_premium')->default(false)->change();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};

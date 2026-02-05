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
        Schema::create('time_entries', function (Blueprint $table) {
           $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->string('project');
    $table->string('task');
    $table->integer('minutes'); 
    $table->date('date');
    $table->string('status')->default('Completed');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_entries');
    }
};

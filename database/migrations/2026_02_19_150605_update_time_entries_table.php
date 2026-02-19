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
         Schema::table('time_entries', function (Blueprint $table) {

        $table->dropColumn(['project', 'task', 'date', 'status']);

        $table->foreignId('project_id')
              ->after('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->foreignId('task_id')
              ->after('project_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->timestamp('start_time')->nullable();
        $table->timestamp('end_time')->nullable();

        $table->integer('minutes')->default(0)->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

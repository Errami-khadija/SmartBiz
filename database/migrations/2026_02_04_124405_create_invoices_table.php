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
       Schema::create('invoices', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('invoice_id')->unique();
        $table->string('client');
        $table->decimal('amount', 10, 2);
        $table->enum('status', ['Paid', 'Pending', 'Overdue']);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

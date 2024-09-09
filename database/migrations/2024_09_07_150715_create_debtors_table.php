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
        Schema::create('debtors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->integer('amount'); // Ensure amount is not nullable
            $table->string('phone_number')->nullable(); // Allow phone_number to be nullable
            $table->date('date_of_acceptance')->nullable(); // Allow date_of_acceptance to be nullable
            $table->date('date_of_issue')->nullable(); // Allow date_of_issue to be nullable
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debtors');
    }
};

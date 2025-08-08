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
        Schema::create('insurance_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('insurance_package_id')->constrained()->onDelete('cascade');
            $table->string('policy_number')->unique();
            $table->enum('status', ['active', 'pending', 'cancelled', 'expired'])->default('pending');
            $table->decimal('premium_amount', 10, 2);
            $table->json('coverage_customizations')->nullable(); // User's coverage modifications
            $table->json('user_provided_data'); // Required data like car registration, etc.
            $table->date('start_date');
            $table->date('end_date');
            $table->date('next_payment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_policies');
    }
};
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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Who earned the commission
            $table->foreignId('from_user_id')->constrained('users')->onDelete('cascade'); // Who generated the commission
            $table->enum('type', ['referral', 'binary', 'rank_bonus', 'override']);
            $table->decimal('amount', 10, 2);
            $table->foreignId('source_policy_id')->nullable()->constrained('insurance_policies')->onDelete('set null');
            $table->integer('level')->default(1); // Level in MLM structure
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
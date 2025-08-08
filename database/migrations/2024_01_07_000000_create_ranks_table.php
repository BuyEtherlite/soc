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
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('requirements'); // Requirements to achieve this rank
            $table->decimal('monthly_salary', 10, 2)->default(0);
            $table->decimal('commission_percentage', 5, 2)->default(0); // Percentage bonus
            $table->json('benefits')->nullable(); // Additional benefits
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('user_ranks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('rank_id')->constrained()->onDelete('cascade');
            $table->date('achieved_at');
            $table->boolean('is_current')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_ranks');
        Schema::dropIfExists('ranks');
    }
};
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
        Schema::create('insurance_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['car', 'health', 'life', 'home', 'travel']);
            $table->text('description');
            $table->decimal('base_premium', 10, 2);
            $table->decimal('coverage_amount', 15, 2);
            $table->decimal('deductible', 10, 2)->default(0);
            $table->json('terms'); // Coverage terms and conditions
            $table->json('required_fields'); // Fields required from user (e.g., car registration)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_packages');
    }
};
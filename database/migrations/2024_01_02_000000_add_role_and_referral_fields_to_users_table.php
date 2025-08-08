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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'admin'])->default('user')->after('email');
            $table->string('referral_code')->unique()->nullable()->after('role');
            $table->foreignId('referred_by')->nullable()->after('referral_code')->constrained('users')->onDelete('set null');
            $table->string('phone')->nullable()->after('referred_by');
            $table->text('address')->nullable()->after('phone');
            $table->decimal('commission_balance', 10, 2)->default(0)->after('address');
            $table->string('mlm_position')->nullable()->after('commission_balance'); // 'left' or 'right' in binary tree
            $table->foreignId('mlm_parent_id')->nullable()->after('mlm_position')->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['referred_by']);
            $table->dropForeign(['mlm_parent_id']);
            $table->dropColumn(['role', 'referral_code', 'referred_by', 'phone', 'address', 'commission_balance', 'mlm_position', 'mlm_parent_id']);
        });
    }
};
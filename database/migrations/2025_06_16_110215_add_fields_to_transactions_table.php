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
        Schema::table('transactions', function (Blueprint $table) {
        $table->string('client')->after('id');
        $table->decimal('total_prix', 10, 2)->after('client');
        $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null')->after('total_prix');
        $table->string('receipt_path')->nullable()->after('user_id');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn(['client', 'total_prix', 'receipt_path']);
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
    }
};

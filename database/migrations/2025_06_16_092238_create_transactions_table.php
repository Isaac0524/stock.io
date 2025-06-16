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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('client');
            $table->decimal('total_prix', 10, 2);
            $table->foreignId('user_id')->constrained('users')->onDelete('set null');
            $table->string('receipt_path')->nullable(); 
            $table->timestamps();
        });

        // Ajouter une colonne transaction_id à la table ventes
        Schema::table('ventes', function (Blueprint $table) {
            $table->foreignId('transaction_id')->nullable()->constrained('transactions')->onDelete('cascade')->after('id');
        });
    }

    public function down()
    {
        Schema::table('ventes', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropColumn('transaction_id');
        });

        Schema::dropIfExists('transactions');
    }
};

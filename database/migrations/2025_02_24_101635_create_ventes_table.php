<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up() {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade'); // Produit vendu
            $table->integer('quantite'); 
            $table->decimal('prix_total', 10, 2);
            $table->string('client')->nullable(); 
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('ventes');
    }
};
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'produit_id',    // ID du produit
        'quantity',      // Quantité en stock
        'type',          // Type de stock (ajout, retrait, etc.)
        'description',   // Description de l'opération de stock
        'user_id',       // ID de l'utilisateur qui a effectué l'opération
    ];
    public function product()
    {
        return $this->belongsTo(Produits::class, 'produit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

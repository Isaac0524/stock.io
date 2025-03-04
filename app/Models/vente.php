<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model {
    use HasFactory;

    protected $fillable = ['produit_id', 'quantite', 'prix_total', 'client'];
    
    protected $casts = [
        'produits' => 'array', // Si vous utilisez json_encode pour stocker les produits
    ];

    public function produit() {
        return $this->belongsTo(Produits::class);
    }
}
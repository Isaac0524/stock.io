<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Ajoutez cette ligne


class Produits extends Model
{
    use HasFactory;

    // Les champs pouvant être remplis
    protected $fillable = [
        'nom',            // Nom du produit
        'description',    // Description du produit
        'prix',           // Prix du produit
        'quantite',       // Quantité en stock
        'image',          // URL ou chemin de l'image
        'categorie_id',   // ID de la catégorie associée
    ];

    // Relation avec la catégorie
    public function categorie()
    {
        return $this->belongsTo(Categories::class);
    }
    public function ventes()
    {
         return $this->hasMany(Vente::class, 'produit_id', 'id');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'produit_id', 'id');
    }
}


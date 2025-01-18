<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    // Les champs pouvant être remplis
    protected $fillable = [
        'nom',          // Nom de la catégorie
        'description',  // Description de la catégorie
    ];

    // Relation avec les produits
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produits;
use App\Models\Stock;

class Vente extends Model
{
    use HasFactory;

    protected $fillable = ['produit_id', 'quantite', 'prix_total', 'client', 'transaction_id', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        // Vérifier le stock avant la création de la vente
        static::creating(function ($vente) {
            $produit = Produits::findOrFail($vente->produit_id);
            if ($produit->quantite < $vente->quantite) {
                throw new \Exception('Stock insuffisant pour ce produit.');
            }
        });

        // Mettre à jour le stock et enregistrer le mouvement après la vente
        static::created(function ($vente) {
            $produit = Produits::findOrFail($vente->produit_id);
            $produit->decrement('quantite', $vente->quantite);

            Stock::create([
                'produit_id' => $vente->produit_id,
                'quantity' => $vente->quantite,
                'type' => 'sortie',
                'description' => "Vente #{$vente->id} pour {$vente->client}",
                'user_id' => $vente->user_id,
            ]);
        });
    }

    public function produit()
    {
        return $this->belongsTo(Produits::class, 'produit_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function transaction()
{
    return $this->belongsTo(Transaction::class);
}
}
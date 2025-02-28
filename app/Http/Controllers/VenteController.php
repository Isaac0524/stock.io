<?php
namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Produits;
use Illuminate\Http\Request;

class VenteController extends Controller
{

    public function create()
    {
        // Récupérer tous les produits pour afficher dans le formulaire de vente
        $produits = Produits::all();
        return view('pages.ventes.create', compact('produits'));
    } 
    public function index()
    {
        // Récupérer toutes les ventes avec les informations du produit
        $ventes = Vente::with('produit')->get();
        return view('pages.ventes.index', compact('ventes'));
    }
    public function store(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
            'client' => 'required|string|max:255',
        ]);

        // Récupérer le produit associé à l'ID
        $produit = Produits::findOrFail($request->produit_id);

        // Vérifier si la quantité demandée est disponible
        if ($produit->quantite < $request->quantite) {

            return redirect()->route('ventes.create')->with('error', 'la quantité demandée n\'est pas disponible.');
        }

        // Calcul du prix total (prix unitaire x quantité)
        $prix_total = $produit->prix * $request->quantite;

        // Créer la vente
        $vente = Vente::create([
            'produit_id' => $request->produit_id,
            'quantite' => $request->quantite,
            'prix_total' => $prix_total,
            'client' => $request->client,
        ]);

        // Mettre à jour la quantité du produit après la vente
        $produit->quantite -= $request->quantite;
        $produit->save();

        // Retourner la réponse
        return redirect()->route('ventes.create')->with('success', 'Vente effectuée avec succès.');
    }

}

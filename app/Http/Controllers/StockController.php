<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{

    public function index()
    {
        $produits = Produits::with('stocks')->paginate(2);
        return view('pages.stocks.index', compact('produits'));
    }

    public function create()
    {
        $produits = Produits::all();
        return view('pages.stocks.create', compact('produits'));
    }

    public function store(Request $request)
    {
        // Décoder le champ JSON reçu du formulaire
        $entries = json_decode($request->input('entries'), true);

        // Validation manuelle du tableau décodé
        if (!is_array($entries) || empty($entries)) {
            return redirect()->back()->withErrors(['entries' => 'Aucune entrée de stock n’a été transmise.']);
        }

        foreach ($entries as $entry) {
            if (!isset($entry['produit_id'], $entry['quantite'])) {
                return redirect()->back()->withErrors(['entries' => 'Format invalide pour une ou plusieurs entrées.']);
            }
        }

        // Exécution dans une transaction
        DB::transaction(function () use ($entries) {
            foreach ($entries as $entry) {
                $produit = Produits::findOrFail($entry['produit_id']);
                $produit->increment('quantite', $entry['quantite']);

                Stock::create([
                    'produit_id' => $entry['produit_id'],
                    'quantity' => $entry['quantite'],
                    'type' => 'entrée',
                    'description' => $entry['description'] ?? null,
                    'user_id' => Auth::id(),
                ]);
            }
        });

        return redirect()->route('stocks.index')->with('success', 'Entrées de stock ajoutées avec succès.');
    }

}
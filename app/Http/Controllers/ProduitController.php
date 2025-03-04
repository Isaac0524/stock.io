<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produits;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;

class ProduitController extends Controller
{
    /**
     * Afficher une liste des produits.
     */
    public function index()
    {
        $produits = Produits::with('categorie')->get();

        return view('pages.Inventaires.index', compact('produits'));
    }

    public function create()
    {
        // Charger toutes les catégories pour le formulaire
        $categories = Categories::all();

            return view('pages.Products.Create', compact('categories'));
        }

        /**
         * Enregistrer un nouveau produit.
         */
        public function store(Request $request)
        {
            // Valider les données de la requête
            $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
                'prix' => 'required|numeric',
                'quantite' => 'required|integer',
                'image' => 'nullable|file|max:5120',
                'categorie_id' => 'required|exists:categories,id', // Valider que la catégorie existe
            ]);

            // Gérer l'image si elle est présente
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
            }

            // Créer un nouveau produit
            Produits::create([
                'nom' => $request->nom,
                'description' => $request->description,
                'prix' => $request->prix,
                'quantite' => $request->quantite,
                'image' => $imagePath,
                'categorie_id' => $request->categorie_id,
            ]);

            return redirect()->route('inventaires.index')->with('success', 'Produit créé avec succès.');
        }

        /**
         * Afficher un produit spécifique.
         */
        public function show(string $id)
        {
            // Trouver le produit par son ID
            $produit = Produits::with('categorie')->findOrFail($id);

            return view('pages.Products.show', compact('produit'));
        }

        /**
         * Afficher le formulaire pour modifier un produit.
         */
        public function edit(string $id)
        {
            // Trouver le produit et charger les catégories
            $produit = Produits::findOrFail($id);
            $categories = Categories::all();

            return view('pages.Products.edit', compact('produit', 'categories'));
        }

        /**
         * Mettre à jour un produit existant.
         */
        public function update(Request $request, string $id)
        {
            // Valider les données de la requête
            $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string',
                'prix' => 'required|numeric',
                'quantite' => 'required|integer',
                'image' => 'nullable|file|max:5120',
                'categorie_id' => 'required|exists:categories,id',
            ]);

            // Trouver le produit
            $produit = Produits::findOrFail($id);

            // Gérer l'image si elle est présente
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($produit->image) {
                    Storage::disk('public')->delete($produit->image);
                }
                $produit->image = $request->file('image')->store('images', 'public');
            }

            // Mettre à jour les champs du produit
            $produit->update([
                'nom' => $request->nom,
                'description' => $request->description,
                'prix' => $request->prix,
                'quantite' => $request->quantite,
                'image' => $produit->image ?? $produit->image,
                'categorie_id' => $request->categorie_id,
            ]);

            return redirect()->route('inventaires.index')->with('success', 'Produit mis à jour avec succès.');
        }

        /**
         * Supprimer un produit.
         */
        public function destroy(string $id)
        {
            // Trouver le produit
            $produit = Produits::findOrFail($id);

            // Supprimer l'image si elle existe
            if ($produit->image) {
                Storage::disk('public')->delete($produit->image);
            }

            // Supprimer le produit
            $produit->delete();

            return redirect()->route('inventaires.index')->with('success', 'Produit supprimé avec succès.');
        }
    }

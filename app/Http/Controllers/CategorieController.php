<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategorieController extends Controller
{
    /**
     * Afficher une liste des catégories.
     */
    public function index()
    {
        try {
            $categories = Categories::paginate(5); // Pagination à 5 catégories par page
            return view('pages.categories.index', compact('categories'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la récupération des catégories : ' . $e->getMessage()]);
        }
    }

    /**
     * Afficher le formulaire pour créer une nouvelle catégorie.
     */
    public function create()
    {
        try {
            return view('pages.categories.create');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de l\'ouverture du formulaire de création : ' . $e->getMessage()]);
        }
    }

    /**
     * Enregistrer une nouvelle catégorie.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);

            Categories::create($request->only(['nom', 'description']));

            return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de l\'ajout de la catégorie : ' . $e->getMessage()]);
        }
    }

    /**
     * Afficher une catégorie spécifique.
     */
    public function show($id)
    {
        try {
            $categorie = Categories::findOrFail($id); // Récupérer la catégorie par son ID
            return view('pages.categories.show', compact('categorie'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de l\'affichage de la catégorie : ' . $e->getMessage()]);
        }
    }

    /**
     * Afficher le formulaire pour modifier une catégorie.
     */
    public function edit($id)
    {
        try {
            $categorie = Categories::findOrFail($id); // Récupérer la catégorie
            return view('pages.categories.edit', compact('categorie'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de l\'ouverture du formulaire de modification : ' . $e->getMessage()]);
        }
    }

    /**
     * Mettre à jour une catégorie existante.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);

            $categorie = Categories::findOrFail($id);
            $categorie->update($request->only(['nom', 'description']));

            return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la mise à jour de la catégorie : ' . $e->getMessage()]);
        }
    }

    /**
     * Supprimer une catégorie.
     */
    public function destroy($id)
    {
        try {
            $categorie = Categories::findOrFail($id); // Récupérer la catégorie
            $categorie->delete(); // Supprimer la catégorie

            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la suppression de la catégorie : ' . $e->getMessage()]);
        }
    }
}

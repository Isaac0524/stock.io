<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produits;

class DashboardController extends Controller
{
    public function index()
    {
        $prodsenStock = Produits::where('quantite', '>', 0)->count(); 
        
        $prodsruptur = Produits::where('quantite', '<=', 0)->get(); 
        
        $nbrProdsruptur = $prodsruptur->count(); 
        
        $produits = Produits::with('categorie')->get(); 
        
        return view('index', compact('prodsenStock', 'prodsruptur', 'nbrProdsruptur', 'produits'));
    }
}

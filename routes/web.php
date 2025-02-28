<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('index');
Route::get('/index', [DashboardController::class, 'index'])->name('index');

// Index : Afficher la liste des produits
Route::get('/products', [ProduitController::class, 'index'])->name('inventaires.index');

// Create : Afficher le formulaire de création d'un produit
Route::get('/products/create', [ProduitController::class, 'create'])->name('Products.create');

// Store : Enregistrer un nouveau produit
Route::post('/products', [ProduitController::class, 'store'])->name('Products.store');

// Edit : Afficher le formulaire de modification d'un produit
Route::get('/products/{id}/edit', [ProduitController::class, 'edit'])->name('Products.edit');

// Update : Mettre à jour un produit existant
Route::put('/products/{id}', [ProduitController::class, 'update'])->name('Products.update');

// Show : Afficher les détails d'un produit spécifique
Route::get('/products/{id}', [ProduitController::class, 'show'])->name('Products.show');

// Destroy : Supprimer un produit
Route::delete('/products/{id}', [ProduitController::class, 'destroy'])->name('Products.destroy');

// Routes des catégories
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::get('/categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

Route::get('/ventes', [VenteController::class, 'index'])->name('ventes.index'); // Historique des ventes
Route::get('/vente/create', [VenteController::class, 'create'])->name('ventes.create'); // Page de création d'une vente
Route::post('/vente', [VenteController::class, 'store'])->name('ventes.store'); // Enregistrer une vente

Route::view('/pages/forms/basic-elements', 'pages.forms.basic-elements  ')->name('forms.basic-elements  ');
Route::view('/pages/charts/chartjs', 'pages.charts.chartjs')->name('charts.chartjs');

Route::view('/pages/icons/mdi', 'pages.icons.mdi')->name('icons.mdi');
Route::view('/pages/samples/login', 'pages.samples.login')->name('auth.login');
Route::view('/pages/samples/register', 'pages.samples.register')->name('auth.register');


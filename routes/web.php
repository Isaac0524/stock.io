<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
//authentification routes 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

route::middleware('auth')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/index', [DashboardController::class, 'index'])->name('index');
    Route::get('ventes', [VenteController::class, 'index'])->name('ventes.index'); // Historique des ventes
    Route::resource('stocks', StockController::class)->only(['index', 'create', 'store']);
    Route::get('/ventes/{id}', [VenteController::class, 'show'])->name('ventes.show');
    Route::get('/ventes/recu/{id}', [VenteController::class, 'generateRecuPDF'])->name('recu.pdf');
    Route::get('/user/ventes/export-pdf', [VenteController::class, 'exportPDF'])->name('ventes.exportPDF'); 
    Route::post('/vente/store', [VenteController::class, 'store'])->name('ventes.store'); // Enregistrer une vente

});

Route::middleware(['auth','user'])->group(function(){
    Route::get('user/vente/create', [VenteController::class, 'create'])->name('ventes.create'); // Page de création d'une vente
    Route::post('user/vente', [VenteController::class, 'store'])->name('ventes.store'); // Enregistrer une vente
    

});

//routes admin 
Route::middleware(['auth','admin'])->group(function(){ 
    //---Routes des Produits ---
    Route::get('admin/products', [ProduitController::class, 'index'])->name('inventaires.index');
    Route::get('admin/products/create', [ProduitController::class, 'create'])->name('Products.create');
    Route::post('admin/products', [ProduitController::class, 'store'])->name('Products.store');
    Route::get('admin/products/{id}/edit', [ProduitController::class, 'edit'])->name('Products.edit');
    Route::put('admin/products/{id}', [ProduitController::class, 'update'])->name('Products.update');
    Route::get('admin/products/{id}', [ProduitController::class, 'show'])->name('Products.show');
    Route::delete('/products/{id}', [ProduitController::class, 'destroy'])->name('Products.destroy');
    // Routes des catégories
    Route::get('admin/categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('admin/categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::get('admin/categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::get('admin/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');
    Route::post('admin/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::put('admin/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('admin/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');
    //statistiques des ventes 
    Route::get('admin/ventes/statistiques', [VenteController::class, 'statistiques'])->name('ventes.statistiques');
    //routes des users 
    Route::resource('admin/users', UserController::class);

});


Route::get('/test-session', function () {
    session(['test' => 'session fonctionne']);
    return session('test');
});

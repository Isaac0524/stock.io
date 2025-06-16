<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>

    <div style="display: flex; height: 100vh; margin: 0; padding: 0;">
        <!-- Navbar / Sidebar -->
        @php
            $user = Auth::user();
        @endphp
        <div
            style="width: 260px; min-width: 220px; background: #e7e9ee; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100;">
            <nav class="sidebar sidebar-offcanvas d-flex flex-column" id="sidebar"
                style="height: 100%; background: transparent;">
                <ul class="nav flex-column" style="flex: 1 1 auto;">
                    <!-- Tableau de bord: visible à tous -->
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('index') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Tableau de bord</span>
                        </a>
                    </li>
                    <!-- Menus réservés à l'admin -->
                    @if ($user && $user->role === 'admin')
                        <!-- Menu Produits -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#menu-produits" aria-expanded="false"
                                aria-controls="menu-produits">
                                <i class="mdi mdi-package-variant-closed menu-icon"></i>
                                <span class="menu-title">Produits</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="menu-produits">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('Products.create') }}">Ajouter un produit</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('categories.index') }}">Catégories</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                    <!-- Menu Ventes: visible à tous, mais options différentes -->
                    <li class="nav-item active">
                        <a class="nav-link" data-bs-toggle="collapse" href="#menu-ventes" aria-expanded="false"
                            aria-controls="menu-ventes" title="Gérez les ventes">
                            <i class="mdi mdi-cash-register menu-icon"></i>
                            <span class="menu-title">Ventes</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="menu-ventes">
                            <ul class="nav flex-column sub-menu">
                                @if ($user && $user->role === 'user')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('ventes.create') }}"
                                            title="Effectuer une vente">Effectuer une vente</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('ventes.index') }}"
                                        title="Voir l'historique">Historique de ventes</a>
                                </li>
                                @if ($user && $user->role === 'admin')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('ventes.statistiques') }}"
                                            title="Voir les stats">Statistiques</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>

                    <!-- Menus réservés à l'admin -->
                    @if ($user && $user->role === 'admin')
                        <!-- Menu Inventaire -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#menu-inventaire" aria-expanded="false"
                                aria-controls="menu-inventaire" title="Gérez l'inventaire">
                                <i class="mdi mdi-clipboard-list menu-icon"></i>
                                <span class="menu-title">Inventaire</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="menu-inventaire">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('inventaires.index') }}"
                                            title="Liste des stocks">Liste des stocks</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Menu Stocks -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#menu-stocks" aria-expanded="false"
                                aria-controls="menu-stocks" title="Gérez les stocks">
                                <i class="mdi mdi-warehouse menu-icon"></i>
                                <span class="menu-title">Stocks</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="menu-stocks">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('stocks.create') }}"
                                            title="Ajouter une entrée de stock">Ajouter une entrée</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('stocks.index') }}"
                                            title="Voir l'historique des stocks">Historique des stocks</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Menu Utilisateurs -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#menu-utilisateurs"
                                aria-expanded="false" aria-controls="menu-utilisateurs">
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                                <span class="menu-title">Utilisateurs</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="menu-utilisateurs">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.create') }}">Ajouter un
                                            utilisateur</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.index') }}">Liste des
                                            utilisateurs</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                </ul>

                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link py-2 logout-link" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout menu-icon"></i>
                            <span class="menu-title">Déconnexion</span>
                        </a>
                    </li>
                    <style>
                        .logout-link {
                            transition: background-color 0.3s, color 0.3s;
                            color: black;
                            background-color: transparent;
                        }

                        .logout-link:hover {
                            background-color: #f8f9fa;
                            color: #007bff;
                        }
                    </style>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>
        <div class="main-panel" style="margin-left:260px; width:calc(100% - 260px);">
            <div class="content-wrapper">
                <!-- Formulaire de sélection des produits (en haut) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2>Effectuer une vente</h2>
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <form id="vente-form">
                                    @csrf
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Produit</th>
                                                    <th style="width:120px;">Quantité</th>
                                                    <th style="width:120px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select class="form-control produit-select" required>
                                                            <option value="">Choisir un produit</option>
                                                            @foreach ($produits as $produit)
                                                                <option value="{{ $produit->id }}"
                                                                    data-nom="{{ $produit->nom }}"
                                                                    data-prix="{{ $produit->prix }}"
                                                                    data-stock="{{ $produit->quantite }}">
                                                                    {{ $produit->nom }} - {{ $produit->quantite }} en
                                                                    stock - {{ number_format($produit->prix, 2) }} FCFA
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control quantite-input"
                                                            min="1" required>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-success add-to-cart">Ajouter</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="client">Client</label>
                                        <input type="text" name="client" id="client" class="form-control"
                                            required>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panier (en bas) -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Panier</h4>
                                <form id="panier-form" action="{{ route('ventes.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="client" id="client-hidden">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="panier-table">
                                            <thead>
                                                <tr>
                                                    <th>Produit</th>
                                                    <th>Quantité</th>
                                                    <th>Prix Unitaire</th>
                                                    <th>Prix Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Les lignes du panier seront ajoutées ici dynamiquement -->
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="3" class="text-end">Total</th>
                                                    <th id="grand-total">0</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="mt-3 d-flex gap-2">
                                        <button type="submit" class="btn btn-primary" id="valider-vente"
                                            disabled>Valider la vente</button>
                                        <button type="button" class="btn btn-danger"
                                            id="annuler-vente">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- content-wrapper ends -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            Copyright © 2025.@Dart
                        </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            <i class="ti-heart text-success ms-1"></i>
                        </span>
                    </div>
                </footer>
            </div>
            <!-- main-panel ends -->
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let panier = [];

                function updatePanierTable() {
                    const tbody = document.querySelector("#panier-table tbody");
                    tbody.innerHTML = "";
                    let total = 0;

                    panier.forEach((item, idx) => {
                        const sousTotal = item.prix * item.quantite;
                        const row = document.createElement("tr");
                        row.innerHTML = `
                <td>
                    <input type="hidden" name="produit_id[]" value="${item.id}">
                    <input type="hidden" name="quantite[]" value="${item.quantite}">
                    <input type="hidden" name="prix_total[]" value="${sousTotal.toFixed(2)}">
                    ${item.nom}
                </td>
                <td>${item.quantite}</td>
                <td>${parseFloat(item.prix).toFixed(0)} FCFA</td>
                <td>${sousTotal.toFixed(0)} FCFA</td>
                <td><button type="button" class="btn btn-sm btn-danger remove-item" data-index="${idx}">Supprimer</button></td>
            `;
                        tbody.appendChild(row);
                        total += sousTotal;
                    });

                    document.getElementById("grand-total").textContent = total.toFixed(0) + " FCFA";
                    document.getElementById("valider-vente").disabled = panier.length === 0;

                    // Mettre à jour le champ client caché
                    document.getElementById("client-hidden").value = document.getElementById("client").value;
                }

                // Ajouter un produit au panier
                document.querySelector(".add-to-cart").addEventListener("click", function() {
                    const produitSelect = document.querySelector(".produit-select");
                    const quantiteInput = document.querySelector(".quantite-input");
                    const produitId = produitSelect.value;
                    const produitNom = produitSelect.options[produitSelect.selectedIndex]?.dataset.nom;
                    const produitPrix = parseFloat(produitSelect.options[produitSelect.selectedIndex]?.dataset
                        .prix) || 0;
                    const produitStock = parseInt(produitSelect.options[produitSelect.selectedIndex]?.dataset
                        .stock) || 0;
                    const quantite = parseInt(quantiteInput.value);

                    if (!produitId || !quantite || quantite < 1) {
                        alert("Veuillez sélectionner un produit et une quantité valide.");
                        return;
                    }

                    if (quantite > produitStock) {
                        alert(
                            `Quantité demandée (${quantite}) supérieure au stock disponible (${produitStock}).`);
                        return;
                    }

                    // Vérifier si le produit est déjà dans le panier
                    const existIdx = panier.findIndex(item => item.id === produitId);
                    if (existIdx !== -1) {
                        // Additionner la quantité si possible
                        const nouvelleQuantite = panier[existIdx].quantite + quantite;
                        if (nouvelleQuantite > produitStock) {
                            alert(
                                `Quantité totale (${nouvelleQuantite}) supérieure au stock disponible (${produitStock}).`);
                            return;
                        }
                        panier[existIdx].quantite = nouvelleQuantite;
                    } else {
                        panier.push({
                            id: produitId,
                            nom: produitNom,
                            prix: produitPrix,
                            quantite: quantite
                        });
                    }

                    updatePanierTable();

                    // Reset le formulaire
                    produitSelect.selectedIndex = 0;
                    quantiteInput.value = "";
                });

                // Supprimer un produit du panier
                document.querySelector("#panier-table tbody").addEventListener("click", function(e) {
                    if (e.target.classList.contains("remove-item")) {
                        const idx = parseInt(e.target.dataset.index);
                        panier.splice(idx, 1);
                        updatePanierTable();
                    }
                });

                // Annuler la vente (vider le panier)
                document.getElementById("annuler-vente").addEventListener("click", function() {
                    if (confirm("Voulez-vous vraiment annuler la vente ?")) {
                        panier = [];
                        updatePanierTable();
                        document.getElementById("vente-form").reset();
                        document.getElementById("client").value = "";
                        document.getElementById("client-hidden").value = "";
                    }
                });

                // Synchroniser le client dans le formulaire panier
                document.getElementById("client").addEventListener("input", function() {
                    document.getElementById("client-hidden").value = this.value;
                });

                // Soumettre la vente
                document.getElementById("panier-form").addEventListener("submit", function(e) {
                    const client = document.getElementById("client").value.trim();

                    if (panier.length === 0) {
                        e.preventDefault();
                        alert("Ajoutez au moins un produit au panier.");
                        return false;
                    }

                    if (!client) {
                        e.preventDefault();
                        alert("Veuillez saisir le nom du client.");
                        document.getElementById("client").focus();
                        return false;
                    }

                    // Copier le client
                    document.getElementById("client-hidden").value = client;

                    // Afficher un message de traitement
                    const submitBtn = document.getElementById("valider-vente");
                    submitBtn.disabled = true;
                    submitBtn.textContent = "Traitement en cours...";

                    return true;
                });

                // Initialisation
                updatePanierTable();
            });

            // Gestion des messages de session
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('error'))
                    alert("{{ session('error') }}");
                @endif

                @if (session('success'))
                    alert("{{ session('success') }}");
                @endif
            });
        </script>
        <!-- page-body-wrapper ends -->
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('status') === 'error')
                    alert("{{ session('message') }}");
                @endif
            });
        </script>
        <!-- inject:js -->
        <script src="../../assets/js/off-canvas.js"></script>
        <script src="../../assets/js/template.js"></script>
        <script src="../../assets/js/settings.js"></script>
        <script src="../../assets/js/todolist.js"></script>
        <!-- endinject -->
</body>

</html>

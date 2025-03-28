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

    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
<nav class="navbar fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex align-items-center">
                <a class="navbar-brand" href="#">
                    <img src="../../assets/images/logo.svg" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout menu-icon"></i>
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Fin Navbar -->

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Tableau de bord</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#menu-produits">
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
                    <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="collapse" href="#menu-ventes" aria-expanded="false"
                          aria-controls="menu-ventes" title="Gérez les ventes">
                          <i class="mdi mdi-cash-register menu-icon"></i>
                          <span class="menu-title">Ventes</span>
                          <i class="menu-arrow"></i>
                      </a>
                      <div class="collapse" id="menu-ventes">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ventes.create') }}" title="Effectuer une vente">
                                    Effectuer une vente
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ventes.index') }}" title="Voir l'historique">
                                    Historique de ventes
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ventes.statistiques') }}" title="Voir les stats">
                                    Statistiques                                
                                </a>
                            </li>
                        </ul>
                    </div>
                  </li>
      
                  <!-- Inventaire -->
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
                                  <a class="nav-link" href="{{ route('inventaires.index') }}" title="Liste des stocks">
                                      Liste des stocks
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <h2>Effectuer une vente</h2>

                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @endif

                                        <form action="{{ route('ventes.store') }}" method="POST">
                                            @csrf
                                        
                                            <!-- Sélection des produits et quantités -->
                                            <div id="produits-container">
                                                <div class="produit-item">
                                                    <div class="form-group">
                                                        <label for="produit_id[]">Produit</label>
                                                        <select name="produit_id[]" class="form-control produit-select" required>
                                                            <option value="">Choisir un produit</option>
                                                            @foreach ($produits as $produit)
                                                                <option value="{{ $produit->id }}" data-prix="{{ $produit->prix }}">
                                                                    {{ $produit->nom }} - {{ $produit->quantite }} en stock - {{ number_format($produit->prix, 2) }} FCFA
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                        
                                                    <div class="form-group">
                                                        <label for="quantite[]">Quantité</label>
                                                        <input type="number" name="quantite[]" class="form-control quantite-input" required min="1">
                                                    </div>
                                        
                                                    <div class="form-group">
                                                        <label for="prix_total[]">Prix Total (FCFA)</label>
                                                        <input type="number" name="prix_total[]" class="form-control prix-total" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <!-- Ajouter plus de produits -->
                                            <button type="button" id="add-product" class="btn btn-secondary">Ajouter un produit</button>
                                        
                                            <!-- Saisie du client -->
                                            <div class="form-group">
                                                <label for="client">Client</label>
                                                <input type="text" name="client" id="client" class="form-control" required>
                                            </div>
                                        
                                            <button type="submit" class="btn btn-primary">Enregistrer la vente</button>
                                        </form>
                                        
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                // Gérer l'ajout de nouveaux produits
                                                document.getElementById("add-product").addEventListener("click", function() {
                                                    var produitContainer = document.getElementById("produits-container");
                                                    var newProductItem = produitContainer.querySelector(".produit-item").cloneNode(true);
                                                    produitContainer.appendChild(newProductItem);
                                                });
                                        
                                                // Calculer le prix total lorsque la quantité ou le produit change
                                                document.getElementById("produits-container").addEventListener("change", function(e) {
                                                    if (e.target.classList.contains("produit-select") || e.target.classList.contains("quantite-input")) {
                                                        updatePrice(e.target);
                                                    }
                                                });
                                        
                                                function updatePrice(target) {
                                                    var parentItem = target.closest(".produit-item");
                                                    var produitSelect = parentItem.querySelector(".produit-select");
                                                    var quantiteInput = parentItem.querySelector(".quantite-input");
                                                    var prixTotalInput = parentItem.querySelector(".prix-total");
                                        
                                                    var prixUnitaire = parseFloat(produitSelect.options[produitSelect.selectedIndex].dataset.prix);
                                                    var quantite = parseInt(quantiteInput.value) || 0;
                                        
                                                    prixTotalInput.value = (prixUnitaire * quantite).toFixed(2);
                                                }
                                            });
                                        </script>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:../../partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Gestion de
                                stock - Tous droits réservés © 2025</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Optimisé pour une
                                gestion efficace</span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if(session('status') === 'error')
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

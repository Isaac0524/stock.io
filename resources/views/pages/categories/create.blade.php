<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>

    <!-- Styles CSS -->
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar -->
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
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                            <i class="icon-bell"></i>
                            <span class="count"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Fin Navbar -->

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
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
            <!-- Fin Sidebar -->

            <!-- Contenu Principal -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Créer une nouvelle Catégorie</h4>
                                    <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nom">Nom de la Catégorie</label>
                                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de la catégorie" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Description de la catégorie" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Créer</button>
                                        <button type="reset" class="btn btn-light">Annuler</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Contenu Principal -->

                <!-- Pied de Page -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            Copyright © 2023. Premium
                            <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a>.
                        </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i>
                        </span>
                    </div>
                </footer>
                <!-- Fin Pied de Page -->
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/template.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
</body>

</html>

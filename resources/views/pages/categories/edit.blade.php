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
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand brand-logo me-5" ><img src="../../assets/images/logo.svg"
                        class="me-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" ><img
                        src="../../assets/images/logo-mini.svg" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item nav-search d-none d-lg-block">
                        <div class="input-group">
                            <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                <span class="input-group-text" id="search">
                                    <i class="icon-search"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                                aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-bs-toggle="dropdown">
                            <i class="icon-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
    
                    <!-- Tableau de Bord -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}" data-bs-toggle="tooltip" title="Tableau de bord">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Tableau de bord</span>
                        </a>
                    </li>
    
                    <!-- Produits -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#menu-produits" aria-expanded="false"
                            aria-controls="menu-produits" title="Gérez les produits">
                            <i class="mdi mdi-package-variant-closed menu-icon"></i>
                            <span class="menu-title">Produits</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="menu-produits">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('Products.create') }}" title="Ajouter un produit">
                                        Ajouter un produit
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categories.index') }}" title="Gérer les catégories">
                                        Catégories
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
    
                    <!-- Ventes -->
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
                                    <div class="container mt-5">
                                        <h2>Modifier la catégorie</h2>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form action="{{ route('categories.update', $categorie->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom de la catégorie</label>
                                                <input type="text" class="form-control" id="name"
                                                    name="nom" value="{{ old('nom', $categorie->nom) }}"
                                                    required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $categorie->description) }}</textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                            <a href="{{ route('categories.index') }}"
                                                class="btn btn-secondary">Annuler</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2025.
                 <a href="#" target="_blank">Prenium acces @MadeByDart</a></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
                <i class="ti-heart text-danger ms-1"></i></span>
        </div>
    </footer>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/template.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>

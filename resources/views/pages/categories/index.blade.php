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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

        <!-- partial --> <!-- partial:../../partials/_sidebar.html -->
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
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#menu-utilisateurs" aria-expanded="false" aria-controls="menu-utilisateurs">
                        <i class="mdi mdi-account-multiple menu-icon"></i>
                        <span class="menu-title">Utilisateurs</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="menu-utilisateurs">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.create') }}">Ajouter un utilisateur</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">Liste des utilisateurs</a>
                            </li>
                        </ul>
                    </div>
                </li>
              </ul>
          </nav>
            <!-- partial -->


            <div class="container">
                <h1 class="mb-4">Liste des Catégories</h1>

                <!-- Bouton pour ajouter une catégorie -->
                <a href="{{ route('categories.create') }}" class="btn btn-success mb-3 shadow-sm">
                    <i class="bi bi-plus-circle me-2"></i> Ajouter une Catégorie
                </a>

                <!-- Table des catégories -->
                <table class="table table-striped table-hover shadow-sm">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $categorie)
                            <tr style="border-top: 1px solid #dee2e6;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $categorie->nom }}</td>
                                <td class="text-wrap" style="word-break: break-word; max-width: 300px;">
                                    {{ $categorie->description }}
                                </td>
                                
                                <td>
                                    <!-- Modifier avec icône -->
                                    <a href="{{ route('categories.edit', $categorie->id) }}"
                                        class="btn btn-sm btn-warning shadow-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- Supprimer avec icône -->
                                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucune catégorie disponible.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-secondary shadow-sm">Afficher plus</button>
        </div>

        <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>

    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a
                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                    class="ti-heart text-danger ms-1"></i></span>
        </div>
    </footer>
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

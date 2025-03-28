<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>

    <!-- partial:partials/_navbar.html -->
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
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Tableau de bord</span>
                    </a>
                </li>

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

                <!-- Menu Ventes -->
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
                                <a class="nav-link" href="{{ route('ventes.create') }}"
                                    title="Effectuer une vente">Effectuer une vente</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ventes.index') }}"
                                    title="Voir l'historique">Historique de ventes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ventes.statistiques') }}"
                                    title="Voir les stats">Statistiques</a>
                            </li>
                        </ul>
                    </div>
                </li>

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

                <!-- Menu Utilisateurs -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#menu-utilisateurs" aria-expanded="false"
                        aria-controls="menu-utilisateurs">
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
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="row">
                            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                <h3 class="font-weight-bold">Gestion de Stock</h3>
                                <h6 class="font-weight-normal mb-0">Suivi en temps réel des stocks et ventes.</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Produits en stock -->
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Produits en stock</p>
                                <p class="fs-30 mb-2">{{ $prodsenStock }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Produits en rupture -->
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">Produits en rupture ({{ $nbrProdsruptur }})</p>
                                @if ($nbrProdsruptur > 0)
                                    <ul class="list-unstyled">
                                        @foreach ($prodsruptur as $produit)
                                            <li>- {{ $produit->nom }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">Aucun produit en rupture</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Tableau des stocks -->
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Tableau des Stocks</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nom du Produit</th>
                                                <th>Catégorie</th>
                                                <th>Prix</th>
                                                <th>Quantité</th>
                                                <th>Statut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($produits as $produit)
                                                <tr>
                                                    <td>{{ $produit->nom }}</td>
                                                    <td>{{ $produit->categorie->nom ?? 'Non catégorisé' }}</td>
                                                    <td>{{ $produit->prix }} FCFA</td>
                                                    <td>{{ $produit->quantite }}</td>
                                                    <td>
                                                        @if ($produit->quantite > 10)
                                                            <span class="badge bg-success">Disponible</span>
                                                        @elseif($produit->quantite > 0)
                                                            <span class="badge bg-warning">Faible stock</span>
                                                        @else
                                                            <span class="badge bg-danger">Rupture</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->

    </div>

    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Gestion de stock - Tous droits
                réservés © 2025</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Optimisé pour une gestion
                efficace</span>
        </div>
    </footer>
    <!-- container-scroller -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status') === 'error')
                alert("{{ session('message') }}");
            @endif
        });
    </script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/chart.umd.js"></script>
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <!-- <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script> -->
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/dataTables.select.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
</body>

</html>
use App\Models\User;
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('pass123'),
    'role' => 'admin'
]);

use Illuminate\Support\Facades\Auth;

Auth::attempt(['email' => 'admin@example.com', 'password' => 'pass123']);

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>StockApp</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>


    <div style="display: flex; height: 100vh; margin: 0; padding: 0;">
        <!-- Sidebar fixe -->
        @php
            $user = Auth::user();
        @endphp
        <div
            style="width: 260px; min-width: 220px; background: #e7e9ee; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100;">
            <nav class="sidebar sidebar-offcanvas d-flex flex-column" id="sidebar"
                style="height: 100%; background: transparent;">
                <ul class="nav flex-column" style="flex: 1 1 auto;">
                    <!-- Tableau de bord: visible à tous -->
                    <li class="nav-item active">
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
                    <li class="nav-item">
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
                                        <a class="nav-link" href="{{ route('users.create') }}">Ajouter un utilisateur</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.index') }}">Liste des utilisateurs</a>
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
        <!-- Contenu principal -->
        <div style="margin-left: 260px; flex: 1; overflow-y: auto; background: #F6F8FF; min-height: 100vh;">
            <div class="main-panel" style="margin-left: 60px; background: transparent;">
                <div class="content-wrapper" style="padding-top: 30px;">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-10 mb-4 mb-xl-0">
                                    <div class="p-4 rounded shadow-sm" style="background: #f8f9fa; color: #343a40;">
                                        <h2 class="font-weight-bold mb-2" style="letter-spacing: 1px;">
                                            Bienvenue sur <span style="color: #4F8DFD;">StockApp</span>
                                        </h2>
                                        <p class="mb-2" style="font-size: 1.15rem;">
                                            Gérez facilement vos stocks, suivez vos ventes et optimisez votre inventaire en temps réel.
                                        </p>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Produits en stock -->
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card" style="background: #8987f3;">
                                <div class="card-body">
                                    <p class="mb-4 text-white">Produits en stock</p>
                                    <p class="fs-30 mb-2 text-white font-weight-bold">{{ $prodsenStock }}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Produits en rupture -->
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card" style="background: #229b12;">
                                <div class="card-body">
                                    <p class="mb-4 text-white">Produits en rupture ({{ $nbrProdsruptur }})</p>
                                    @if ($nbrProdsruptur > 0)
                                        <ul class="list-unstyled text-white">
                                            @foreach ($prodsruptur as $produit)
                                                <li>- {{ $produit->nom }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-white">Aucun produit en rupture</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Tableau des stocks -->
                                <div class="card-body">
                                    <strong><p class="card-title">Tableau des Produits </p></strong>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" style="font-family: 'Segoe UI', Arial, sans-serif;">
                                            <thead class="table-success">
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
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $produits->links() }}
                                </div>
                                </div>
                            </div>
                </div>
            </div>
            <footer class="footer mt-auto py-3" style="background: #e7e9ee; position: absolute; left: 260px; right: 0; bottom: 0; width: auto;">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                        Copyright © 2025.@Dart
                    </span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                        <i class="ti-heart text-success ms-1"></i>
                    </span>
                </div>
            </footer>
            <style>
                html, body {
                    height: 100%;
                }
                body {
                    position: relative;
                    min-height: 100vh;
                }
                .footer {
                    z-index: 10;
                }
            </style>
        </div>

    </div>
    <!-- container-scroller -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status') === 'error')
                alert("{{ session('message') }}");
            @endif
        });
    </script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <!-- <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script> -->
    <script src="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
</body>

</html>
<!--use App\Models\User;
User::create([
    'username' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('pass123'),
    'role' => 'admin'
]);

use Illuminate\Support\Facades\Auth;

Auth::attempt(['email' => 'admin@example.com', 'password' => 'pass123']);
-->

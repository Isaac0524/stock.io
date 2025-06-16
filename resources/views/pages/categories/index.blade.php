<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">

    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- endinject -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
    <div style="display: flex; height: 100vh; margin: 0; padding: 0;">
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
                        <li class="nav-item active">
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
        <!-- partial -->

        <div
            style="margin-left: 260px; flex: 1; overflow-y: auto; background: #f8f9fa; min-height: 100vh; padding: 40px 30px 30px 30px;">
            <h3 class="mb-4"><i class="fa fa-list-alt me-2 text-primary"></i>Liste des Catégories </h3>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('categories.create') }}" class="btn btn-primary d-inline-flex align-items-center">
                    <i class="fa fa-plus me-1"></i>Ajouter une catégorie
                </a>
            </div>
            <div class="card-body">
                <h4 class="card-title">Liste des Produits</h4>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Fermer"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Fermer"></button>
                    </div>
                @endif
            </div>

            <!-- Table des catégories -->
            <div class="table-responsive rounded shadow-sm">
                <table class="table table-hover align-middle mb-0"
                    style="background: #fff; border-radius: 10px; overflow: hidden;">
                    <thead style="background: #e9ecef;">
                        <tr>
                            <th scope="col" style="width: 60px;">#</th>
                            <th scope="col"><i class="fa fa-tag me-1 text-secondary"></i>Nom</th>
                            <th scope="col"><i class="fa fa-align-left me-1 text-secondary"></i>Description</th>
                            <th scope="col" style="width: 180px;"><i
                                    class="fa fa-cogs me-1 text-secondary"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $categorie)
                            <tr style="border-top: 1px solid #f1f1f1;">
                                <td class="fw-bold text-primary">{{ $loop->iteration }}</td>
                                <td>{{ $categorie->nom }}</td>
                                <td class="text-wrap" style="word-break: break-word; max-width: 300px;">
                                    {{ $categorie->description }}
                                </td>
                                <td>
                                    <!-- Modifier avec icône -->
                                    <a href="{{ route('categories.edit', $categorie->id) }}"
                                        class="btn btn-sm btn-outline-warning me-2 d-inline-flex align-items-center"
                                        title="Modifier">
                                        <i class="fa fa-edit me-1"></i>
                                    </a>
                                    <!-- Supprimer avec icône -->
                                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-danger d-inline-flex align-items-center"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')"
                                            title="Supprimer">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fa fa-folder-open fa-2x mb-2"></i><br>
                                    Aucune catégorie disponible.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-4">
                {{ $categories->links('pagination::bootstrap-4') }}
            </div>
            <style>
                .table thead th {
                    border-bottom: 2px solid #dee2e6;
                    font-weight: 600;
                    color: #495057;
                }

                .table-hover tbody tr:hover {
                    background-color: #f1f7fd;
                    transition: background 0.2s;
                }

                .btn-outline-warning:hover,
                .btn-outline-danger:hover {
                    color: #fff !important;
                }
            </style>
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

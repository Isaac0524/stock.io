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
                        <li class="nav-item ">
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
                        <li class="nav-item active">
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
        <!-- Fin Sidebar -->

        <!-- Main Content -->
        <div class="main-panel" style="margin-left:260px; width:calc(100% - 260px);">
            <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                    <div class="container mt-4">
                        <h1 class="mb-4">Gestion des Utilisateurs</h1>

                        <div class="mb-3">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Ajouter un
                            utilisateur</a>
                        </div>

                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
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
                            aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <button type="button"
                                    class="btn btn-warning btn-sm edit-btn"
                                    data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-id="{{ $user->id }}"
                                    data-name="{{ $user->username }}"
                                    data-email="{{ $user->email }}"
                                    data-role="{{ $user->role }}">
                                    Modifier
                                    </button>

                                    @if (auth()->user()->id === $user->id)
                                    <button class="btn btn-danger btn-sm" disabled>Supprimer</button>
                                    @else
                                    <form action="{{ route('users.destroy', $user->id) }}"
                                        method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                        class="btn btn-danger btn-sm">Supprimer</button>
                                    </form>
                                    @endif
                                </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>

                        <!-- Modal de modification -->
                        <div class="modal fade" id="editModal" tabindex="-1"
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Modifier
                                l'utilisateur</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <form id="editUserForm" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                <div class="form-group mb-3">
                                    <label for="edit-username">Nom</label>
                                    <input type="text" name="username" id="edit-username"
                                    class="form-control" placeholder="Nom" required>
                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="edit-email">Email</label>
                                    <input type="email" name="email" id="edit-email"
                                    class="form-control" placeholder="Email" required>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="edit-role">Rôle</label>
                                    <select name="role" id="edit-role"
                                    class="form-control" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    </select>
                                    @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>

                                <div class="modal-footer">
                                <button type="submit"
                                    class="btn btn-primary">Enregistrer</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </form>


                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    </div>
                </div>
                </div>
            </div>

            </div>
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
        <!-- End Main Content -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Confirmation de suppression
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                        e.preventDefault();
                    }
                });
            });

            // Gestion du modal d'édition
            const editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const username = button.getAttribute('data-username');
                const email = button.getAttribute('data-email');
                const role = button.getAttribute('data-role');

                // Remplir les champs dans le formulaire
                document.getElementById('edit-username').value = username;
                document.getElementById('edit-email').value = email;
                document.getElementById('edit-role').value = role;

                // Modifier l'action du formulaire
                const form = document.getElementById('editUserForm');
                form.action = `/admin/users/${id}`; // adapte selon ta route réelle
            });
        });
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>StockApp - Ajouter des entrées de stock</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <style>

    </style>
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
                        <li class="nav-item active">
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
        <div
            style="margin-left: 260px; flex: 1; overflow-y: auto; background: #f8f9fb; min-height: 100vh; padding: 40px 0;">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card shadow-sm border-0 rounded-4" style="background: #fff;">
                            <div class="card-body p-5">

                                <!-- Messages -->
                                @if (session('success'))
                                    <div class="alert alert-success d-flex align-items-center mb-4">
                                        <i class="fa fa-check-circle me-2"></i>
                                        <span>{{ session('success') }}</span>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger mb-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fa fa-exclamation-triangle me-2"></i>
                                            <strong>Erreurs :</strong>
                                        </div>
                                        <ul class="mb-0 ps-4">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row g-5">
                                    <!-- Formulaire -->
                                    <div class="col-md-5">
                                        <h4 class="mb-4 fw-bold" style="color: #222;">
                                            <i class="mdi mdi-plus-box-multiple-outline me-2"
                                                style="color: #888;"></i>
                                            Nouvelle entrée
                                        </h4>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="color: #444;">Produit
                                                *</label>
                                            <select id="produit_id" class="form-select shadow-sm" required
                                                style="background: #f5f6fa; border-color: #e0e3ea;">
                                                <option value="">Sélectionnez un produit</option>
                                                @foreach ($produits as $produit)
                                                    <option value="{{ $produit->id }}"
                                                        data-nom="{{ $produit->nom }}">
                                                        {{ $produit->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" style="color: #444;">Quantité
                                                *</label>
                                            <input type="number" id="quantite" class="form-control shadow-sm"
                                                min="1" required
                                                style="background: #f5f6fa; border-color: #e0e3ea;">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold"
                                                style="color: #444;">Description</label>
                                            <input type="text" id="description" class="form-control shadow-sm"
                                                style="background: #f5f6fa; border-color: #e0e3ea;">
                                        </div>
                                        <button type="button" id="add-entry" class="btn w-100 mt-2 py-2 fw-bold"
                                            style="background: #29cf6e; color: #fff; border-radius: 0.5rem;">
                                            <i class="fa fa-plus me-1"></i> Ajouter
                                        </button>
                                    </div>

                                    <!-- Tableau des entrées -->
                                    <div class="col-md-7">
                                        <h4 class="mb-4 fw-bold" style="color: #222;">
                                            <i class="mdi mdi-format-list-bulleted-type me-2"
                                                style="color: #888;"></i>
                                            Entrées en attente
                                        </h4>
                                        <div class="table-responsive rounded-3 shadow-sm">
                                            <table class="table table-hover align-middle mb-0" id="entries-table"
                                                style="background: #fafbfc;">
                                                <thead class="table-light" style="background: #f1f3f7;">
                                                    <tr>
                                                        <th style="color: #555;">Produit</th>
                                                        <th style="color: #555;">Quantité</th>
                                                        <th style="color: #555;">Description</th>
                                                        <th class="text-center" style="color: #555;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Formulaire principal -->
                                <form id="stock-form" action="{{ route('stocks.store') }}" method="POST"
                                    class="mt-5">
                                    @csrf
                                    <input type="hidden" name="entries" id="entries-input">
                                    <button type="submit" class="btn px-5 py-2 fw-bold" id="submit-all" disabled
                                        style="background: #1a7c5b; color: #fff; border-radius: 0.5rem;">
                                        <i class="fa fa-check me-1"></i> Valider toutes les entrées
                                    </button>
                                </form>
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
            <style>
                .btn-gradient-primary {
                    background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
                    color: #fff;
                    border: none;
                }

                .btn-gradient-primary:hover {
                    background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
                    color: #fff;
                }

                .btn-gradient-success {
                    background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
                    color: #fff;
                    border: none;
                }

                .btn-gradient-success:hover {
                    background: linear-gradient(90deg, #38f9d7 0%, #43e97b 100%);
                    color: #fff;
                }

                .card {
                    border-radius: 1.5rem !important;
                }

                .form-control,
                .form-select {
                    border-radius: 0.75rem;
                }

                .table thead th {
                    border-top: none;
                }

                .table td,
                .table th {
                    vertical-align: middle;
                }

                .table-responsive {
                    background: #fff;
                }
            </style>
        </div>

    </div>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script>
        let entries = [];

        document.getElementById('add-entry').addEventListener('click', () => {
            const produitSelect = document.getElementById('produit_id');
            const quantite = document.getElementById('quantite').value;
            const description = document.getElementById('description').value;

            const produitId = produitSelect.value;
            const produitNom = produitSelect.options[produitSelect.selectedIndex].getAttribute('data-nom');

            if (!produitId || quantite < 1) {
                alert('Veuillez sélectionner un produit et saisir une quantité valide.');
                return;
            }

            const entry = {
                produit_id: produitId,
                produit_nom: produitNom,
                quantite,
                description
            };
            entries.push(entry);
            updateTable();
            document.getElementById('submit-all').disabled = entries.length === 0;
        });

        function updateTable() {
            const tbody = document.querySelector('#entries-table tbody');
            tbody.innerHTML = '';

            entries.forEach((entry, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${entry.produit_nom}</td>
            <td>${entry.quantite}</td>
            <td>${entry.description || '-'}</td>
            <td>
                <button type="button" class="btn btn-light btn-sm" style="color: #e74c3c; border: 1px solid #e74c3c; background: #fff3f3;" onclick="removeEntry(${index})">
                    <i class="mdi mdi-delete"></i>
                </button>
            </td>
            `;
                tbody.appendChild(row);
            });

            document.getElementById('entries-input').value = JSON.stringify(entries);
        }

        function removeEntry(index) {
            entries.splice(index, 1);
            updateTable();
            document.getElementById('submit-all').disabled = entries.length === 0;
        }
    </script>
</body>

</html>

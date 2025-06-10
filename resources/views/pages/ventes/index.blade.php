<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skydash Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Correction pour la pagination */
        .pagination {
            display: flex;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }

        .pagination li {
            margin-left: 5px;
        }

        .pagination li a,
        .pagination li span {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #5D5CDE;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .pagination li.active span {
            z-index: 3;
            color: #fff;
            background-color: #5D5CDE;
            border-color: #5D5CDE;
        }

        .pagination li.disabled span {
            color: #6c757d;
            pointer-events: none;
            cursor: auto;
            background-color: #fff;
            border-color: #dee2e6;
        }

        /* Style des boutons de filtre */
        .btn-filter {
            transition: all 0.3s;
        }

        .btn-filter.active {
            background-color: #5D5CDE !important;
            color: white !important;
            border-color: #5D5CDE !important;
        }

        /* Info des filtres */
        .filter-info {
            background-color: #f8f9fa;
            border-left: 3px solid #5D5CDE;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            margin-right: 5px;
        }

        .badge-primary {
            color: #fff;
            background-color: #5D5CDE;
        }

        .badge-info {
            color: #fff;
            background-color: #17a2b8;
        }
    </style>
</head>

<body>
    <div style="display: flex; height: 100vh; margin: 0; padding: 0;">
        <!-- Sidebar fixe -->
        <div
            style="width: 260px; min-width: 220px; background: #e7e9ee; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100;">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas d-flex flex-column" id="sidebar"
                style="height: 100%; background: transparent;">
                <ul class="nav flex-column" style="flex: 1 1 auto;">
                    <li class="nav-item ">
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
                    <li class="nav-item active">
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
        </div><!-- Main Panel -->

        <div style="margin-left: 260px; flex: 1; overflow-y: auto; background: #f8f9fa; min-height: 100vh;">
            
                <div class="row" style="margin-left: 10px ;  padding-top: 20px; margin-right: 10px;">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Filtrer les ventes</h4>

                                <!-- Notification de filtre actif (initialement cachée) -->
                                <div id="filter-notification" class="alert alert-info filter-notification mb-3"
                                    style="display: none;">
                                    <i class="fa fa-info-circle mr-2"></i>
                                    <span id="filter-message">Filtre appliqué</span>
                                </div>

                                <form action="{{ route('ventes.index') }}" method="GET" id="filter-form">
                                    <!-- Champ caché pour le type de période -->
                                    <input type="hidden" name="periode" id="periode"
                                        value="{{ request('periode') }}">

                                    <div class="row mb-3">
                                        <div class="col-md-3 mb-2">
                                            <button type="button" id="btn-daily"
                                                class="btn btn-outline-primary btn-block btn-filter {{ request('periode') == 'daily' ? 'active' : '' }}">
                                                <i class="fa fa-calendar-day mr-1"></i> Journalier
                                            </button>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <button type="button" id="btn-weekly"
                                                class="btn btn-outline-primary btn-block btn-filter {{ request('periode') == 'weekly' ? 'active' : '' }}">
                                                <i class="fa fa-calendar-week mr-1"></i> Hebdomadaire
                                            </button>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <button type="button" id="btn-monthly"
                                                class="btn btn-outline-primary btn-block btn-filter {{ request('periode') == 'monthly' ? 'active' : '' }}">
                                                <i class="fa fa-calendar-alt mr-1"></i> Mensuel
                                            </button>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <button type="button" id="btn-quarterly"
                                                class="btn btn-outline-primary btn-block btn-filter {{ request('periode') == 'quarterly' ? 'active' : '' }}">
                                                <i class="fa fa-chart-pie mr-1"></i> Trimestriel
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 mb-2">
                                            <div class="form-group">
                                                <label for="date_debut">Date de début :</label>
                                                <input type="date" name="date_debut" id="date_debut"
                                                    class="form-control" value="{{ request('date_debut') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-5 mb-2">
                                            <div class="form-group">
                                                <label for="date_fin">Date de fin :</label>
                                                <input type="date" name="date_fin" id="date_fin"
                                                    class="form-control" value="{{ request('date_fin') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary btn-block">
                                                <i class="fa fa-filter mr-1"></i> Filtrer
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-left: 10px ;  padding-top: 20px; margin-right: 10px;">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title mb-0">Historique des ventes</h4>
                                    <div>
                                        <a href="{{ route('ventes.exportPDF', request()->all()) }}"
                                            class="btn btn-danger">
                                            <i class="fa fa-file-pdf mr-1"></i> Exporter PDF
                                        </a>
                                    </div>
                                </div>

                                <!-- Résumé des filtres appliqués -->
                                @if (request('date_debut') || request('date_fin') || request('periode'))
                                    <div class="filter-info mb-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-filter text-primary mr-2"></i>
                                            <span>
                                                <strong>Filtres appliqués:</strong>
                                                @if (request('periode') && request('periode') != 'custom')
                                                    <span
                                                        class="badge badge-primary">{{ ucfirst(request('periode')) }}</span>
                                                @endif
                                                @if (request('date_debut'))
                                                    <span class="badge badge-info">Du
                                                        {{ \Carbon\Carbon::parse(request('date_debut'))->format('d/m/Y') }}</span>
                                                @endif
                                                @if (request('date_fin'))
                                                    <span class="badge badge-info">Au
                                                        {{ \Carbon\Carbon::parse(request('date_fin'))->format('d/m/Y') }}</span>
                                                @endif
                                            </span>
                                            <a href="{{ route('ventes.index') }}"
                                                class="btn btn-sm btn-outline-danger ml-auto">
                                                <i class="fa fa-times mr-1"></i> Effacer les filtres
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if (count($ventes) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Produit</th>
                                                    <th>Quantité</th>
                                                    <th>Prix Total</th>
                                                    <th>Client</th>
                                                    <th>Vendeur</th>
                                                    <th>Date</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($ventes as $vente)
                                                    <tr>
                                                        <td>{{ $vente->produit->nom }}</td>
                                                        <td>{{ $vente->quantite }}</td>
                                                        <td>{{ number_format($vente->prix_total, 0, ',', ' ') }} FCFA
                                                        </td>
                                                        <td>{{ $vente->client }}</td>
                                                        <td>{{ $vente->user->username ?? 'Utilisateur supprimé' }}</td>
                                                        <!-- Affiche le nom de l'utilisateur -->
                                                        <td>{{ \Carbon\Carbon::parse($vente->created_at)->format('d/m/Y H:i') }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('recu.pdf', $vente->id) }}"
                                                                class="btn btn-sm btn-success">
                                                                <i class="fa fa-download"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mt-4 d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="text-muted">
                                                Affichage de {{ $ventes->firstItem() ?? 0 }} à
                                                {{ $ventes->lastItem() ?? 0 }} sur {{ $ventes->total() }} résultats
                                            </p>
                                        </div>
                                        <div>
                                            {{ $ventes->links() }}
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <img src="{{ asset('assets/images/no-data.svg') }}" alt="Aucune donnée"
                                            style="max-width: 200px; opacity: 0.5;">
                                        <h4 class="mt-3 text-muted">Aucune vente trouvée pour cette période</h4>
                                        <p class="text-muted">Essayez de modifier les filtres ou d'ajouter de nouvelles
                                            ventes</p>
                                    </div>
                                @endif
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

          
        </div>
     
    </div>


    <!-- Scripts -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status') === 'error')
                alert("{{ session('message') }}");
            @endif
        });
    </script>

    <script>
        $(document).ready(function() {
            // Initialisation des dates par défaut si elles ne sont pas définies
            const initializeDates = () => {
                const today = new Date();
                if (!$('#date_fin').val()) {
                    const formattedEndDate = today.toISOString().split('T')[0];
                    $('#date_fin').val(formattedEndDate);
                }

                if (!$('#date_debut').val() && !$('#periode').val()) {
                    // Par défaut: 7 jours en arrière
                    const sevenDaysAgo = new Date();
                    sevenDaysAgo.setDate(today.getDate() - 7);
                    const formattedStartDate = sevenDaysAgo.toISOString().split('T')[0];
                    $('#date_debut').val(formattedStartDate);
                }
            };

            // Gestion des boutons de période
            $('#btn-daily').click(function(e) {
                e.preventDefault();
                $('.btn-filter').removeClass('active');
                $(this).addClass('active');
                $('#periode').val('daily');
                $('#filter-form').submit();
            });

            $('#btn-weekly').click(function(e) {
                e.preventDefault();
                $('.btn-filter').removeClass('active');
                $(this).addClass('active');
                $('#periode').val('weekly');
                $('#filter-form').submit();
            });

            $('#btn-monthly').click(function(e) {
                e.preventDefault();
                $('.btn-filter').removeClass('active');
                $(this).addClass('active');
                $('#periode').val('monthly');
                $('#filter-form').submit();
            });

            $('#btn-quarterly').click(function(e) {
                e.preventDefault();
                $('.btn-filter').removeClass('active');
                $(this).addClass('active');
                $('#periode').val('quarterly');
                $('#filter-form').submit();
            });

            // Lorsque l'utilisateur remplit manuellement les dates et clique sur "Filtrer"
            $('button[type="submit"]').click(function() {
                if ($('#date_debut').val() || $('#date_fin').val()) {
                    $('#periode').val('custom');
                    $('.btn-filter').removeClass('active');
                }
            });

            // Correction du style de la pagination
            $('.pagination').addClass('justify-content-end');

            // Initialiser les dates
            initializeDates();
        });
    </script>
</body>

</html>

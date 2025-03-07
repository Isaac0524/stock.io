<!DOCTYPE html>
<html lang="fr">
<head>
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
    <style>
        .btn-filter {
            transition: all 0.3s;
        }
        
        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-filter.active {
            background-color: #5D5CDE !important;
            color: white !important;
            border-color: #5D5CDE !important;
        }

        .card {
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .table th {
            background-color: #f9fafb;
            border-top: none;
            font-weight: 600;
        }
        
        .table tbody tr {
            transition: all 0.2s;
        }
        
        .table tbody tr:hover {
            background-color: #f8f9ff;
        }
            
        .filter-card {
            border-left: 4px solid #5D5CDE;
        }
        
        .receipt-btn {
            color: #28a745;
            transition: all 0.2s;
        }
        
        .receipt-btn:hover {
            color: #218838;
            transform: translateY(-2px);
        }
        
        /* Animation pour les notifications de filtre */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .filter-notification {
            animation: fadeInDown 0.5s ease-out;
        }
        
        /* Badges personnalisés */
        .badge-quantity {
            background-color: #e0e7ff;
            color: #5D5CDE;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .badge-date {
            background-color: #e6f7ff;
            color: #0088cc;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ route('index') }}">
                    <img src="{{ asset('assets/images/logo.svg') }}" class="mr-2" alt="logo"/>
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ route('index') }}">
                    <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo"/>
                </a>
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
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Rechercher" aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        
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
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card filter-card">
                                <div class="card-body">
                                    <h4 class="card-title">Filtrer les ventes</h4>
                                    
                                    <!-- Notification de filtre actif (initialement cachée) -->
                                    <div id="filter-notification" class="alert alert-info filter-notification mb-3" style="display: none;">
                                        <i class="fa fa-info-circle mr-2"></i>
                                        <span id="filter-message">Filtre appliqué</span>
                                    </div>
                                    
                                    <form action="{{ route('ventes.index') }}" method="GET" id="filter-form">
                                        <div class="row mb-3">
                                            <div class="col-md-3 mb-2">
                                                <button type="button" id="btn-daily" class="btn btn-outline-primary btn-block btn-filter {{ request('periode') == 'daily' ? 'active' : '' }}">
                                                    <i class="fa fa-calendar-day mr-1"></i> Journalier
                                                </button>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <button type="button" id="btn-weekly" class="btn btn-outline-primary btn-block btn-filter {{ request('periode') == 'weekly' ? 'active' : '' }}">
                                                    <i class="fa fa-calendar-week mr-1"></i> Hebdomadaire
                                                </button>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <button type="button" id="btn-monthly" class="btn btn-outline-primary btn-block btn-filter {{ request('periode') == 'monthly' ? 'active' : '' }}">
                                                    <i class="fa fa-calendar-alt mr-1"></i> Mensuel
                                                </button>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <button type="button" id="btn-quarterly" class="btn btn-outline-primary btn-block btn-filter {{ request('periode') == 'quarterly' ? 'active' : '' }}">
                                                    <i class="fa fa-chart-pie mr-1"></i> Trimestriel
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="periode" id="periode" value="{{ request('periode') }}">
                                        
                                        <div class="row">
                                            <div class="col-md-5 mb-2">
                                                <div class="form-group">
                                                    <label for="date_debut">Date de début :</label>
                                                    <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ request('date_debut') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5 mb-2">
                                                <div class="form-group">
                                                    <label for="date_fin">Date de fin :</label>
                                                    <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ request('date_fin') }}">
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
                    
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4 class="card-title mb-0">Historique des ventes</h4>
                                        <div>
                                            <a href="{{ route('ventes.exportPDF', request()->all()) }}" class="btn btn-danger">
                                                <i class="fa fa-file-pdf mr-1"></i> Exporter PDF
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- Résumé des filtres appliqués -->
                                    @if(request('date_debut') || request('date_fin') || request('periode'))
                                        <div class="alert alert-light mb-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-filter text-primary mr-2"></i>
                                                <span>
                                                    <strong>Filtres appliqués:</strong> 
                                                    @if(request('periode'))
                                                        <span class="badge badge-primary">{{ ucfirst(request('periode')) }}</span>
                                                    @endif
                                                    @if(request('date_debut'))
                                                        <span class="badge badge-info">Du {{ \Carbon\Carbon::parse(request('date_debut'))->format('d/m/Y') }}</span>
                                                    @endif
                                                    @if(request('date_fin'))
                                                        <span class="badge badge-info">Au {{ \Carbon\Carbon::parse(request('date_fin'))->format('d/m/Y') }}</span>
                                                    @endif
                                                </span>
                                                <a href="{{ route('ventes.index') }}" class="btn btn-sm btn-outline-danger ml-auto">
                                                    <i class="fa fa-times mr-1"></i> Effacer les filtres
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if(count($ventes) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Produit</th>
                                                        <th scope="col">Quantité</th>
                                                        <th scope="col">Prix Total</th>
                                                        <th scope="col">Client</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ventes as $vente)
                                                        <tr>
                                                            <td>
                                                                <span class="font-weight-medium">{{ $vente->produit->nom }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-quantity">{{ $vente->quantite }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="font-weight-bold text-success">{{ number_format($vente->prix_total, 0, ',', ' ') }} FCFA</span>
                                                            </td>
                                                            <td>{{ $vente->client }}</td>
                                                            <td>
                                                                <span class="badge badge-date">
                                                                    {{ \Carbon\Carbon::parse($vente->created_at)->format('d/m/Y H:i') }}
                                                                </span>
                                                            </td>
                                                           
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="mt-4 d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="text-muted">
                                                    Affichage de {{ $ventes->firstItem() ?? 0 }} à {{ $ventes->lastItem() ?? 0 }} sur {{ $ventes->total() }} résultats
                                                </p>
                                            </div>
                                            <div>
                                                {{ $ventes->links() }}
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <img src="{{ asset('assets/images/no-data.png') }}" alt="Aucune donnée" style="max-width: 200px; opacity: 0.5;">
                                            <h4 class="mt-3 text-muted">Aucune vente trouvée pour cette période</h4>
                                            <p class="text-muted">Essayez de modifier les filtres ou d'ajouter de nouvelles ventes</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            Gestion de stock - Tous droits réservés © 2025
                        </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            Optimisé pour une gestion efficace
                        </span>
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
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    
    <!-- Custom js for this page-->
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
            
            // Fonctions pour les différentes périodes
            const setDailyFilter = () => {
                const today = new Date();
                const formattedDate = today.toISOString().split('T')[0];
                $('#date_debut').val(formattedDate);
                $('#date_fin').val(formattedDate);
                $('#periode').val('daily');
                
                showFilterNotification('Filtre journalier appliqué - ' + formatDate(today));
                
                // Active le bouton correspondant
                $('.btn-filter').removeClass('active');
                $('#btn-daily').addClass('active');
                
                // Soumet le formulaire
                $('#filter-form').submit();
            };
            
            const setWeeklyFilter = () => {
                const today = new Date();
                const startOfWeek = new Date(today);
                startOfWeek.setDate(today.getDate() - today.getDay()); // Dimanche = 0, Lundi = 1, etc.
                
                $('#date_debut').val(startOfWeek.toISOString().split('T')[0]);
                $('#date_fin').val(today.toISOString().split('T')[0]);
                $('#periode').val('weekly');
                
                showFilterNotification('Filtre hebdomadaire appliqué - Semaine du ' + formatDate(startOfWeek) + ' au ' + formatDate(today));
                
                // Active le bouton correspondant
                $('.btn-filter').removeClass('active');
                $('#btn-weekly').addClass('active');
                
                // Soumet le formulaire
                $('#filter-form').submit();
            };
            
            const setMonthlyFilter = () => {
                const today = new Date();
                const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                
                $('#date_debut').val(startOfMonth.toISOString().split('T')[0]);
                $('#date_fin').val(today.toISOString().split('T')[0]);
                $('#periode').val('monthly');
                
                const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                showFilterNotification('Filtre mensuel appliqué - ' + monthNames[today.getMonth()] + ' ' + today.getFullYear());
                
                // Active le bouton correspondant
                $('.btn-filter').removeClass('active');
                $('#btn-monthly').addClass('active');
                
                // Soumet le formulaire
                $('#filter-form').submit();
            };
            
            const setQuarterlyFilter = () => {
                const today = new Date();
                const currentQuarter = Math.floor(today.getMonth() / 3);
                const startOfQuarter = new Date(today.getFullYear(), currentQuarter * 3, 1);
                
                $('#date_debut').val(startOfQuarter.toISOString().split('T')[0]);
                $('#date_fin').val(today.toISOString().split('T')[0]);
                $('#periode').val('quarterly');
                
                const quarterNumber = currentQuarter + 1;
                showFilterNotification('Filtre trimestriel appliqué - Q' + quarterNumber + ' ' + today.getFullYear());
                
                // Active le bouton correspondant
                $('.btn-filter').removeClass('active');
                $('#btn-quarterly').addClass('active');
                
                // Soumet le formulaire
                $('#filter-form').submit();
            };
            
            // Fonction utilitaire pour formater la date
            const formatDate = (date) => {
                const day = date.getDate().toString().padStart(2, '0');
                const month = (date.getMonth() + 1).toString().padStart(2, '0');
                return `${day}/${month}/${date.getFullYear()}`;
            };
            
            // Fonction pour afficher une notification de filtre
            const showFilterNotification = (message) => {
                $('#filter-message').text(message);
                $('#filter-notification').fadeIn();
                
                // Cache la notification après 5 secondes
                setTimeout(() => {
                    $('#filter-notification').fadeOut();
                }, 5000);
            };
            
            // Événements pour les boutons de période
            $('#btn-daily').click(setDailyFilter);
            $('#btn-weekly').click(setWeeklyFilter);
            $('#btn-monthly').click(setMonthlyFilter);
            $('#btn-quarterly').click(setQuarterlyFilter);
            
            // Assure que le formulaire soumet la période même avec les dates personnalisées
            $('#filter-form').on('submit', function() {
                if (!$('#periode').val() && $('#date_debut').val() && $('#date_fin').val()) {
                    $('#periode').val('custom');
                }
            });
            
            // Initialise les dates au chargement
            initializeDates();
            
            // Active le bouton correspondant à la période actuelle
            if ($('#periode').val()) {
                const periodeBtn = $('#btn-' + $('#periode').val());
                if (periodeBtn.length) {
                    periodeBtn.addClass('active');
                }
            }
        });
    </script>
    <!-- End custom js for this page-->
</body>
</html>
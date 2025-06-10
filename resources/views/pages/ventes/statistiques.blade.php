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
    <title>Statistiques des Ventes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            color: #333;
            margin-bottom: 25px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reduce-btn {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            color: #333;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card.primary {
            border-left: 4px solid #4e73df;
        }

        .stat-card.success {
            border-left: 4px solid #1cc88a;
        }

        .stat-card.info {
            border-left: 4px solid #6f42c1;
        }

        .stat-card.warning {
            border-left: 4px solid #f6c23e;
        }

        .stat-card h3 {
            color: #888;
            font-size: 14px;
            margin-top: 0;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            color: #333;
        }

        .stat-detail {
            font-size: 13px;
            color: #888;
            margin-top: 5px;
        }

        .trend-up {
            color: #1cc88a;
        }

        .trend-down {
            color: #e74a3b;
        }

        .icon-container {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .icon-primary {
            background-color: #4e73df;
        }

        .icon-success {
            background-color: #1cc88a;
        }

        .icon-info {
            background-color: #6f42c1;
        }

        .icon-warning {
            background-color: #f6c23e;
        }

        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .chart-title {
            color: #333;
            font-size: 16px;
            margin-top: 0;
            margin-bottom: 15px;
            font-weight: 600;
        }

        canvas {
            width: 100% !important;
            height: 300px !important;
        }

        @media (max-width: 768px) {
            .charts-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
    <div style="display: flex; height: 100vh; margin: 0; padding: 0;">
        <!-- Navbar / Sidebar -->
        <div
            style="width: 260px; min-width: 220px; background: #e7e9ee; position: fixed; top: 0; left: 0; height: 100vh; z-index: 100;">
            <nav class="sidebar sidebar-offcanvas d-flex flex-column" id="sidebar"
                style="height: 100%; background: transparent;">
                <ul class="nav flex-column" style="flex: 1 1 auto;">
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
        </div>
        <!-- partial -->
        <div class="main-panel" style="margin-left:260px; width:calc(100% - 260px); background: #f8f9fa;">
            <div class="content-wrapper" style="padding: 40px 30px;">
                <div class="container">
                    <h2>
                        Statistiques de la période
                        <button class="reduce-btn">Réduire</button>
                    </h2>

                    <div class="stats-grid">
                        <!-- Carte 1 - Total des ventes -->
                        <div class="stat-card primary">
                            <h3>Total des ventes</h3>
                            <p class="stat-value">{{ number_format($totalVentes, 0, ',', ' ') }} FCFA</p>
                            <p class="stat-detail trend-up">
                                <i class="fas fa-arrow-up"></i>
                            </p>
                            <div class="icon-container icon-primary">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>

                        <!-- Carte 2 - Nombre de ventes -->
                        <div class="stat-card success">
                            <h3>Nombre de ventes</h3>
                            <p class="stat-value">{{ $nombreVentes }}</p>
                            <p class="stat-detail trend-up">
                                <i class="fas fa-arrow-up"></i>
                            </p>
                            <div class="icon-container icon-success">
                                <i class="fas fa-receipt"></i>
                            </div>
                        </div>

                        <!-- Carte 3 - Produit le plus vendu -->
                        <div class="stat-card info">
                            <h3>Produit le plus vendu</h3>
                            @if ($produitPlusVendu)
                                <p class="stat-value">{{ $produitPlusVendu->nom }}</p>
                                <p class="stat-detail">
                                    {{ $produitPlusVendu->ventes_count ?? 0 }} unités vendues
                                </p>
                            @else
                                <p class="stat-value">Aucun</p>
                                <p class="stat-detail">Aucune vente enregistrée</p>
                            @endif
                            <div class="icon-container icon-info">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>

                        <!-- Carte 4 - Client principal -->
                        <div class="stat-card warning">
                            <h3>Client principal</h3>
                            @if ($clientPrincipal)
                                <p class="stat-value">{{ $clientPrincipal->client ?? $clientPrincipal->nom }}</p>
                                <p class="stat-detail">
                                    {{ $clientPrincipal->total_achats ?? 0 }} achats,
                                    {{ number_format($clientPrincipal->total_depense ?? 0, 0, ',', ' ') }} FCFA
                                </p>
                            @else
                                <p class="stat-value">Aucun</p>
                                <p class="stat-detail">Aucune donnée disponible</p>
                            @endif
                            <div class="icon-container icon-warning">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>

                    <div class="charts-container">
                        <!-- Graphique 1 - Ventes par période -->
                        <div class="chart-card">
                            <h3 class="chart-title">Ventes par période</h3>
                            @if ($dates->isEmpty())
                                <p style="padding: 10px;">Aucune vente enregistrée pour générer le graphique.</p>
                            @else
                                <canvas id="ventesParPeriode"></canvas>
                            @endif
                        </div>

                        <!-- Graphique 2 - Répartition des ventes par produit -->
                        <div class="chart-card">
                            <h3 class="chart-title">Répartition des ventes par produit</h3>
                            @if ($produitsLabels->isEmpty())
                                <p style="padding: 10px;">Aucune donnée produit disponible pour ce graphique.</p>
                            @else
                                <canvas id="repartitionProduits"></canvas>
                            @endif
                        </div>
                    </div>
                </div>

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                            Copyright © 2025. @Dart
                        </span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            <i class="ti-heart text-success ms-1"></i>
                        </span>
                    </div>
                </footer>
            </div>
        </div>

        <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
        <script>
            // Préparation des données (adaptation aux différents formats possibles)
            const dates = @json(
                $dates ??
                    array_map(function ($item) {
                        return $item->date ?? $item;
                    }, $ventesParDate ?? []));

            const ventesValues = @json(
                $ventes ??
                    array_map(function ($item) {
                        return $item->total ?? $item;
                    }, $ventesParDate ?? []));

            // Configuration du graphique des ventes par période
            const ctx1 = document.getElementById('ventesParPeriode').getContext('2d');
            new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Ventes (FCFA)',
                        data: ventesValues,
                        borderColor: '#4e73df',
                        backgroundColor: 'rgba(78, 115, 223, 0.1)',
                        borderWidth: 2,
                        pointBackgroundColor: '#4e73df',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y.toLocaleString('fr-FR') + ' FCFA';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000) {
                                        return value / 1000 + 'k';
                                    }
                                    return value;
                                }
                            }
                        }
                    }
                }
            });

            // Configuration du graphique de répartition par produit
            const ctx2 = document.getElementById('repartitionProduits').getContext('2d');
            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: @json($produitsLabels),
                    datasets: [{
                        data: @json($produitsQuantites),
                        backgroundColor: [
                            '#4e73df', // Bleu
                            '#e74a3b', // Rouge
                            '#36b9cc', // Bleu clair
                            '#1cc88a', // Vert
                            '#f6c23e', // Jaune
                            '#6f42c1' // Violet
                        ],
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                boxWidth: 15
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return label + ': ' + value + ' unités (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });

            // Fonctionnalité du bouton "Réduire"
            document.querySelector('.reduce-btn').addEventListener('click', function() {
                const charts = document.querySelector('.charts-container');
                if (charts.style.display === 'none') {
                    charts.style.display = 'grid';
                    this.textContent = 'Réduire';
                } else {
                    charts.style.display = 'none';
                    this.textContent = 'Développer';
                }
            });
        </script>
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

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
    <a class="navbar-brand brand-logo me-5" ><img src="../../assets/images/logo.svg" class="me-2" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" ><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
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
          <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
    <ul class="navbar-nav navbar-nav-right">
     
    </ul>

  </div>
</nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
  <li class="nav-item">
    <a class="nav-link" href="{{ route('index') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Accédez à votre tableau de bord principal">
      <i class="icon-grid menu-icon"></i>
      <span class="menu-title">Tableau de bord</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic" data-bs-toggle="tooltip" data-bs-placement="right" title="Gérez les produits de votre stock">
      <i class="icon-layout menu-icon"></i>
      <span class="menu-title">Produits</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> 
          <a class="nav-link" href="{{ route('Products.create') }}" data-bs-toggle="tooltip" title="Ajoutez un nouveau produit à votre inventaire">Ajouter un produit</a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link" href="{{ route('categories.index') }}" data-bs-toggle="tooltip" title="Gérez les catégories des produits">Catégories</a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link" href="#" data-bs-toggle="tooltip" title="Consultez l'historique des produits ajoutés ou supprimés">Historique des produits</a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic" data-bs-toggle="tooltip" data-bs-placement="right" title="Gérez les produits de votre stock">
      <i class="icon-layout menu-icon"></i>
      <span class="menu-title">Ventes</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> 
          <a class="nav-link" href="{{ route('ventes.create') }}" data-bs-toggle="tooltip" title="vendre un Produit ">Effectue une vente</a>
        </li>
        <li class="nav-item"> 
          <a class="nav-link" href="{{ route('ventes.index') }}" data-bs-toggle="tooltip" title="Voir l'historique ">Historique de Ventes </a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements" data-bs-toggle="tooltip" data-bs-placement="right" title="Gérez les commandes des clients">
      <i class="icon-columns menu-icon"></i>
      <span class="menu-title">Commandes</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="form-elements">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link"    data-bs-toggle="tooltip" title="Visualisez et modifiez les commandes des clients">Gérer les commandes</a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts" data-bs-toggle="tooltip" data-bs-placement="right" title="Analysez les statistiques de gestion des stocks">
      <i class="icon-bar-graph menu-icon"></i>
      <span class="menu-title">Statistiques</span>
      <i class="menu-arrow"></i>
    </a>
      <div class="collapse" id="charts">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> 
          <a class="nav-link" href="{{ route('charts.chartjs') }} "  data-bs-toggle="tooltip" title="Consultez les statistiques de vos stocks">Analyse des stocks</a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables" data-bs-toggle="tooltip" data-bs-placement="right" title="Gérez les articles de votre inventaire">
      <i class="icon-grid-2 menu-icon"></i>
      <span class="menu-title">Inventaire</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="tables">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item"> 
          <a class="nav-link" href="{{ route('inventaires.index') }}" data-bs-toggle="tooltip" title="Affichez et gérez la liste complète des articles en stock">Liste des stocks</a>
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
                    <div class="container">
                        <h2>Historique des ventes</h2>
                    
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Quantité</th>
                                    <th>Prix Total</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventes as $vente)
                                    <tr>
                                        <td>{{ $vente->produit->nom }}</td>
                                        <td>{{ $vente->quantite }}</td>
                                        <td>{{ $vente->prix_total }} FCFA</td>
                                        <td>{{ $vente->client }}</td>
                                        <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                     
                      
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
         <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Gestion de stock - Tous droits réservés © 2025</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Optimisé pour une gestion efficace</span>
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
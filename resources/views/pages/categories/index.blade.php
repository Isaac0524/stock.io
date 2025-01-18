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
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <a class="navbar-brand brand-logo me-5" href="../../index.html"><img src="../../assets/images/logo.svg" class="me-2" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../assets/images/logo-mini.svg" alt="logo" /></a>
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
      <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="icon-bell mx-0"></i>
          <span class="count"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-success">
                <i class="ti-info-alt mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Application Error</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> Just now </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="ti-settings mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">Settings</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> Private message </p>
            </div>
          </a>
          <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-info">
                <i class="ti-user mx-0"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <h6 class="preview-subject font-weight-normal">New user registration</h6>
              <p class="font-weight-light small-text mb-0 text-muted"> 2 days ago </p>
            </div>
          </a>
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
          <img src="../../assets/images/faces/face28.jpg" alt="profile" />
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item">
            <i class="ti-settings text-primary"></i> Settings </a>
          <a class="dropdown-item">
            <i class="ti-power-off text-primary"></i> Logout </a>
        </div>
      </li>
      <li class="nav-item nav-settings d-none d-lg-flex">
        <a class="nav-link" href="#">
          <i class="icon-ellipsis"></i>
        </a>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>
      <!-- partial -->        <!-- partial:../../partials/_sidebar.html -->
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
            <a class="nav-link" href="#"" data-bs-toggle="tooltip" title="Consultez l'historique des produits ajoutés ou supprimés">Historique des produits</a>
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
            <a class="nav-link" href="{{ route('forms.basic-elements') }}" data-bs-toggle="tooltip" title="Visualisez et modifiez les commandes des clients">Gérer les commandes</a>
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
            <a class="nav-link" href="{{ route('charts.chartjs') }}" data-bs-toggle="tooltip" title="Consultez les statistiques de vos stocks">Analyse des stocks</a>
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
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons" data-bs-toggle="tooltip" data-bs-placement="right" title="Gérez vos partenaires fournisseurs">
        <i class="icon-contract menu-icon"></i>
        <span class="menu-title">Fournisseurs</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="icons">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('icons.mdi') }}" data-bs-toggle="tooltip" title="Consultez la liste des fournisseurs">Liste des fournisseurs</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth" data-bs-toggle="tooltip" data-bs-placement="right" title="Gérez l'accès des utilisateurs">
        <i class="icon-head menu-icon"></i>
        <span class="menu-title">Utilisateurs</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('auth.login') }}" data-bs-toggle="tooltip" title="Connectez-vous à l'application">Connexion</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('auth.register') }}" data-bs-toggle="tooltip" title="Créez un compte utilisateur">Inscription</a>
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
                  <td>{{ $categorie->description }}</td>
                  <td>
                    <!-- Modifier avec icône -->
                    <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-sm btn-warning shadow-sm">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                    <!-- Supprimer avec icône -->
                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" style="display: inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
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
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ms-1"></i></span>
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
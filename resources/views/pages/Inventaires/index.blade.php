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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand brand-logo me-5"><img src="../../assets/images/logo.svg" class="me-2"
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini"><img src="../../assets/images/logo-mini.svg"
                        alt="logo" /></a>
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
                            <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now"
                                aria-label="search" aria-describedby="search">
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-bs-toggle="dropdown">
                            <i class="icon-bell mx-0"></i>
                            <span class="count"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
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
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Liste des Produits</h4>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Nom du Produit</th>
                                                <th>Catégorie</th>
                                                <th>Prix</th>
                                                <th>Quantité</th>
                                                <th>Évaluation</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($produits as $produit)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $produit->image) }}"
                                                            alt="Image du produit"
                                                            style="width: 50px; height: 50px; border-radius: 5px;">
                                                    </td>
                                                    <td>{{ $produit->nom }}</td>
                                                    <td>{{ $produit->categorie->nom ?? 'Sans catégorie' }}</td>
                                                    <td>{{ $produit->prix }} CFA </td>
                                                    <td>{{ $produit->quantite }}</td>
                                                    <td>
                                                        @php
                                                            $rating = $produit->evaluation ?? 0;
                                                        @endphp
                                                        <div style="display: flex; align-items: center;">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $rating)
                                                                    <i class="mdi mdi-star" style="color: gold;"></i>
                                                                @else
                                                                    <i class="mdi mdi-star-outline"
                                                                        style="color: gray;"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </td>
                                                    <td class="action-buttons">
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#viewProductModal{{ $produit->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <a href="{{ route('Products.edit', ['id' => $produit->id]) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('Products.destroy', ['id' => $produit->id]) }}"
                                                            method="POST" style="display: inline-block;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <!-- Modal pour afficher les détails du produit -->
                                                <div class="modal fade" id="viewProductModal{{ $produit->id }}"
                                                    tabindex="-1"
                                                    aria-labelledby="viewProductLabel{{ $produit->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="viewProductLabel{{ $produit->id }}">
                                                                    {{ $produit->nom }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('storage/' . $produit->image) }}"
                                                                    alt="{{ $produit->nom }}" class="img-fluid mb-3"
                                                                    style="max-height: 250px;">
                                                                <p><strong>Catégorie :</strong>
                                                                    {{ $produit->categorie->nom ?? 'Sans catégorie' }}
                                                                </p>
                                                                <p><strong>Description :</strong>
                                                                    {{ $produit->description }}</p>
                                                                <p><strong>Prix :</strong> {{ $produit->prix }} FCFA
                                                                </p>
                                                                <p><strong>Quantité :</strong> {{ $produit->quantite }}
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-secondary">Afficher plus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. Premium <a
                    href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from
                BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                    class="ti-heart text-danger ms-1"></i></span>
        </div>
    </footer>
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

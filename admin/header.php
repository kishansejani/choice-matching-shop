<?php include_once 'connection.php';

if (!isset($_SESSION['login_id'])) {
  header('location:index.php');
}

/* To find the URL */
$url = isset($_SERVER['HTTPS']) &&
  $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";


$url = $_SERVER['REQUEST_URI'];



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  <!-- Ion Slider -->
  <link rel="stylesheet" href="plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="plugins/bootstrap-slider/css/bootstrap-slider.min.css">

  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">

  <!-- CodeMirror -->
  <link rel="stylesheet" href="plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <!-- <link rel="stylesheet" href="plugins/simplemde/simplemde.min.css"> -->

  <!-- jsGrid -->
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid-theme.min.css">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="plugins/fullcalendar/main.css">

  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">

  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- pace-progress -->
  <link rel="stylesheet" href="plugins/pace-progress/themes/black/pace-theme-flat-top.css">

  <!-- flag-icon-css -->
  <link rel="stylesheet" href="plugins/flag-icon-css/css/flag-icon.min.css">

  <style>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: right;
      padding-right: .75rem;
    }

    .color-palette.disabled {
      text-align: center;
      padding-right: 0;
      display: block;
    }

    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette.disabled span {
      display: block;
      text-align: left;
      padding-left: .75rem;
    }

    .color-palette-box h4 {
      position: absolute;
      left: 1.25rem;
      margin-top: .75rem;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }

    /* PREMIUM BRANDING THEME OVERRIDES */
    :root {
      --primary-color: #13213B;
      --accent-color: #EF9C78;
      --bg-soft: #f8fafc;
      --text-muted: #666e7d;
    }

    body {
      font-family: 'Inter', 'Source Sans Pro', sans-serif;
    }

    /* Navbar */
    .main-header.navbar {
      background-color: var(--primary-color) !important;
      border-bottom: none !important;
    }

    .main-header .nav-link {
      color: rgba(255, 255, 255, 0.8) !important;
    }

    .main-header .nav-link:hover {
      color: #fff !important;
    }

    /* Sidebar */
    .main-sidebar {
      background-color: #0d1729 !important;
      box-shadow: 10px 0 30px rgba(0, 0, 0, 0.1) !important;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {
      background: var(--accent-color) !important;
      color: #1c325c !important;
      box-shadow: 0 4px 15px rgba(239, 156, 120, 0.3) !important;
      font-weight: 600;
      border-radius: 8px;
    }

    .nav-sidebar .nav-link {
      border-radius: 8px;
      margin-bottom: 5px;
      transition: all 0.3s;
    }

    .nav-sidebar .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.05) !important;
      color: var(--accent-color) !important;
    }

    .brand-link {
      background-color: var(--primary-color) !important;
      color: var(--accent-color) !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
      padding: 20px 15px !important;
    }

    .brand-text {
      font-weight: 800 !important;
      letter-spacing: 1px;
    }

    /* Cards */
    .card {
      border: none !important;
      border-radius: 12px !important;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05) !important;
    }

    .card-primary.card-outline {
      border-top: 3px solid var(--accent-color) !important;
    }

    .card-primary:not(.card-outline)>.card-header {
      background-color: var(--primary-color) !important;
      color: #fff !important;
    }

    /* Buttons */
    .btn-primary {
      background-color: var(--accent-color) !important;
      border-color: var(--accent-color) !important;
      color: #fff !important;
      font-weight: 600;
      border-radius: 6px;
      box-shadow: 0 4px 12px rgba(239, 156, 120, 0.2) !important;
    }

    .btn-primary:hover {
      background-color: #e08b68 !important;
      border-color: #e08b68 !important;
      transform: translateY(-1px);
    }

    /* Form Elements */
    .form-control:focus {
      border-color: var(--accent-color) !important;
      box-shadow: 0 0 0 3px rgba(239, 156, 120, 0.1) !important;
    }

    /* Stat Boxes */
    .bg-premium-blue {
      background-color: var(--primary-color) !important;
      color: #fff !important;
    }

    .bg-premium-peach {
      background-color: var(--accent-color) !important;
      color: #fff !important;
    }

    .bg-premium-dark {
      background-color: #0d1729 !important;
      color: #fff !important;
    }

    .small-box {
      border-radius: 12px !important;
      overflow: hidden;
    }

    .small-box-footer {
      background-color: rgba(0, 0, 0, 0.1) !important;
    }

    .content-wrapper {
      background-color: var(--bg-soft) !important;
    }

    /* Tables */
    .table thead th {
      background-color: #f1f5f9;
      border-bottom: 2px solid #e2e8f0;
      color: var(--primary-color);
      font-weight: 700;
      text-transform: uppercase;
      font-size: 12px;
    }

    a {
      color: var(--primary-color);
    }

    a:hover {
      color: var(--accent-color);
      text-decoration: none;
    }
    /* Preloader fallback - Removed because it blocks interaction */
    .preloader {
      display: none !important;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader removed -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="dashboard.php" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">

            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>

          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">

            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>

          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">

            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
  
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> -->

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">CHOICE MATCHING</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../images/radhi.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">CHOICE MATCHING</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

        <!-- Dashboard -->
        <!-- Dashboard -->
        <nav class="mt-2">
          <ul class="nav nav-sidebar flex-column nav-pills" data-widget="treeview" role="menu" data-accordion="true">
            <li class="nav-item">
              <a href="dashboard.php"
                class="nav-link <?php if (strpos($url, 'dashboard.php') !== false)
                  echo "active"; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <!-- Slider -->
            <li class="nav-item <?php if (strpos($url, 'slider.php') !== false)
              echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, 'slider.php') !== false)
                echo "active"; ?>">
                <i class="nav-icon fas fa-images"></i>
                <p>Slider <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-slider.php"
                    class="nav-link <?php if (strpos($url, 'add-slider.php') !== false)
                      echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Slider</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view-slider.php"
                    class="nav-link <?php if (strpos($url, 'view-slider.php') !== false)
                      echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View/Manage Slider</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Products -->
            <li class="nav-item <?php if (strpos($url, 'product.php') !== false)
              echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, 'product.php') !== false)
                echo "active"; ?>">
                <i class="nav-icon fas fa-tshirt"></i>
                <p>Products <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-product.php"
                    class="nav-link <?php if (strpos($url, 'add-product.php') !== false)
                      echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Product</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view-product.php"
                    class="nav-link <?php if (strpos($url, 'view-product.php') !== false)
                      echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View/Manage Product</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Blog -->
            <li class="nav-item <?php if (strpos($url, 'blog.php') !== false)
              echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, 'blog.php') !== false)
                echo "active"; ?>">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>Blog <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-blog.php"
                    class="nav-link <?php if (strpos($url, 'add-blog.php') !== false)
                      echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Blog</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view-blog.php"
                    class="nav-link <?php if (strpos($url, 'view-blog.php') !== false)
                      echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View/Manage Blog</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- About -->
            <li class="nav-item <?php if (strpos($url, 'manage-about.php') !== false)
              echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, 'manage-about.php') !== false)
                echo "active"; ?>">
                <i class="nav-icon fas fa-info-circle"></i>
                <p>About <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="manage-about.php"
                    class="nav-link <?php if (strpos($url, 'manage-about.php') !== false)
                      echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage About-Us</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Orders -->
            <li class="nav-item <?php if (strpos($url, 'order.php') !== false)
              echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, 'order.php') !== false)
                echo "active"; ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Orders <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="view-received-order.php"
                    class="nav-link <?php if (strpos($url, 'view-received-order.php') !== false)
                      echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New Received Orders</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view-all-orders.php"
                    class="nav-link <?php if (strpos($url, 'view-all-orders.php') !== false)
                      echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Past Orders Data</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Home Page Management -->
            <li class="nav-item <?php if (strpos($url, 'home-') !== false) echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, 'home-') !== false) echo "active"; ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>Home Page <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="manage-home-banners.php" class="nav-link <?php if (strpos($url, 'manage-home-banners.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Banners</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="manage-home-benefits.php" class="nav-link <?php if (strpos($url, 'manage-home-benefits.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Benefits</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="manage-home-promo.php" class="nav-link <?php if (strpos($url, 'manage-home-promo.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Promo Banner</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="manage-home-brands.php" class="nav-link <?php if (strpos($url, 'manage-home-brands.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Manage Brands</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Categories -->
            <li class="nav-item <?php if (strpos($url, '-category.php') !== false) echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, '-category.php') !== false) echo "active"; ?>">
                <i class="nav-icon fas fa-list"></i>
                <p>Categories <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-category.php" class="nav-link <?php if (strpos($url, 'add-category.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view-category.php" class="nav-link <?php if (strpos($url, 'view-category.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Category</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Sub-Categories -->
            <li class="nav-item <?php if (strpos($url, '-subcategory.php') !== false) echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, '-subcategory.php') !== false) echo "active"; ?>">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>Sub-Categories <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-subcategory.php" class="nav-link <?php if (strpos($url, 'add-subcategory.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Sub-Category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view-subcategory.php" class="nav-link <?php if (strpos($url, 'view-subcategory.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Sub-Category</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Sizes -->
            <li class="nav-item <?php if (strpos($url, '-size.php') !== false) echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, '-size.php') !== false) echo "active"; ?>">
                <i class="nav-icon fas fa-ruler-combined"></i>
                <p>Sizes <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-size.php" class="nav-link <?php if (strpos($url, 'add-size.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Size</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view-size.php" class="nav-link <?php if (strpos($url, 'view-size.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Size</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Colors -->
            <li class="nav-item <?php if (strpos($url, '-color.php') !== false) echo "menu-open"; ?>">
              <a href="#" class="nav-link <?php if (strpos($url, '-color.php') !== false) echo "active"; ?>">
                <i class="nav-icon fas fa-palette"></i>
                <p>Colors <i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="add-color.php" class="nav-link <?php if (strpos($url, 'add-color.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Color</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="view-color.php" class="nav-link <?php if (strpos($url, 'view-color.php') !== false) echo "active"; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View Colors</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Contact Settings -->
            <li class="nav-item">
              <a href="manage-contact.php" class="nav-link <?php if (strpos($url, 'manage-contact.php') !== false) echo "active"; ?>">
                <i class="nav-icon fas fa-address-book"></i>
                <p>Contact Info</p>
              </a>
            </li>

            <!-- Log-out -->
            <li class="nav-item">
              <a href="log-out.php" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Log-out</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
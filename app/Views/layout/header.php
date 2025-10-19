<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?? 'Dashboard'; ?> | Premix Manager</title>

  <!-- SB Admin 2 CSS -->
  <link href="/assets/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
  <link href="/assets/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-cogs"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Premix Manager</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Items -->
    <li class="nav-item <?= uri_string() == '' ? 'active' : '' ?>">
      <a class="nav-link" href="/">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item <?= uri_string() == 'produk' ? 'active' : '' ?>">
      <a class="nav-link" href="/produk">
        <i class="fas fa-box"></i>
        <span>Data Produk</span>
      </a>
    </li>

    <li class="nav-item <?= uri_string() == 'transaksi' ? 'active' : '' ?>">
      <a class="nav-link" href="/transaksi">
        <i class="fas fa-exchange-alt"></i>
        <span>Transaksi</span>
      </a>
    </li>

    <li class="nav-item <?= uri_string() == 'laporan' ? 'active' : '' ?>">
      <a class="nav-link" href="/laporan">
        <i class="fas fa-file-alt"></i>
        <span>Laporan</span>
      </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
      <a class="nav-link text-danger" href="/logout">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </a>
    </li>

  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>
        <span class="navbar-brand mb-0 h5">Sistem Manajemen Premix</span>
      </nav>
      <!-- End of Topbar -->

      <!-- Begin Page Content -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>DPU Opname &amp; Inventory | <?php echo $title; ?></title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-indigo elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard') ?>" class="brand-link">
      <img src="<?php echo base_url('assets') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">DPU Opname</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('assets') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrator</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="<?php echo base_url('dashboard') ?>" class="nav-link<?php echo ($page == 'dashboard') ? ' active' : ''; ?>">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dasbor
                  </p>
                </a>
            </li>
            <li class="nav-item has-treeview<?php echo ($page == 'unit' || $page == 'facility') ? ' menu-open' : ''; ?>">
                <a href="#" class="nav-link<?php echo ($page == 'unit' || $page == 'facility') ? ' active' : ''; ?>">
                  <i class="nav-icon fas fa-archive"></i>
                  <p>
                    Data Master
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('unit') ?>" class="nav-link<?php echo ($page == 'unit') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Unit</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('facility') ?>" class="nav-link<?php echo ($page == 'facility') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Fasilitas</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item has-treeview<?php echo ($page == 'report_facility') ? ' menu-open' : ''; ?>">
                <a href="#" class="nav-link<?php echo ($page == 'report_facility') ? ' active' : ''; ?>">
                  <i class="nav-icon fas fa-print"></i>
                  <p>
                    Laporan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('report/facility') ?>" class="nav-link<?php echo ($page == 'report_facility') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Fasilitas Kamar</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('dashboard/logout') ?>" class="nav-link">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    Keluar
                  </p>
                </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

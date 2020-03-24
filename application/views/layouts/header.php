<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>DPU Bills | <?php echo $title; ?></title>

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
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('dashboard') ?>" class="brand-link">
      <img src="<?php echo base_url('assets') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">DPU Bills</span>
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
            <li class="nav-item has-treeview<?php echo ($page == 'residence' || $page == 'mansion' || $page == 'rate') ? ' menu-open' : ''; ?>">
                <a href="#" class="nav-link<?php echo ($page == 'residence' || $page == 'mansion' || $page == 'rate') ? ' active' : ''; ?>">
                  <i class="nav-icon fas fa-archive"></i>
                  <p>
                    Data Master
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('residence') ?>" class="nav-link<?php echo ($page == 'residence') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Apartemen</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('mansion') ?>" class="nav-link<?php echo ($page == 'mansion') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mansion</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('rate') ?>" class="nav-link<?php echo ($page == 'rate') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tarif</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item has-treeview<?php echo ($page == 'trans_1' || $page == 'trans_2') ? ' menu-open' : ''; ?>">
                <a href="#" class="nav-link<?php echo ($page == 'trans_1' || $page == 'trans_2') ? ' active' : ''; ?>">
                  <i class="nav-icon fas fa-calculator"></i>
                  <p>
                    Input Tagihan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('transaction/index/1') ?>" class="nav-link<?php echo ($page == 'trans_1') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Apartemen</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('transaction/index/2') ?>" class="nav-link<?php echo ($page == 'trans_2') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mansion</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item has-treeview<?php echo ($page == 'payment_1' || $page == 'payment_2') ? ' menu-open' : ''; ?>">
                <a href="#" class="nav-link<?php echo ($page == 'payment_1' || $page == 'payment_2') ? ' active' : ''; ?>">
                  <i class="nav-icon fas fa-money-bill-alt"></i>
                  <p>
                    Input Pembayaran
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('payment/index/1') ?>" class="nav-link<?php echo ($page == 'payment_1') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Apartemen</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('payment/index/2') ?>" class="nav-link<?php echo ($page == 'payment_2') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mansion</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item has-treeview<?php echo ($page == 'bill_1' || $page == 'bill_2') ? ' menu-open' : ''; ?>">
                <a href="#" class="nav-link<?php echo ($page == 'bill_1' || $page == 'bill_2') ? ' active' : ''; ?>">
                  <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                    Cek Tagihan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('bill/index/1') ?>" class="nav-link<?php echo ($page == 'bill_1') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Apartemen</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('bill/index/2') ?>" class="nav-link<?php echo ($page == 'bill_2') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Mansion</p>
                    </a>
                  </li>
                </ul>
            </li>
            <li class="nav-item has-treeview<?php echo ($page == 'period') ? ' menu-open' : ''; ?>">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-print"></i>
                  <p>
                    Laporan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url('report/period') ?>" class="nav-link<?php echo ($page == 'period') ? ' active' : ''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Per Periode</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Tunggakan</p>
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

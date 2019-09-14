<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/AdminLTE.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Style Datatable -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/style.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Leaftlet JS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/leaflet/leaflet.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>asset/plugins/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/maprouting/dist/leaflet-routing-machine.css">
  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>asset/bower_components/jquery/dist/jquery.mask.min.js"></script>
  <script src="<?php echo base_url() ?>asset/bower_components/jquery/dist/jquery.json-2.4.min.js"></script>
  <script src="<?php echo base_url() ?>asset/leaflet/leaflet.js"></script>
  <script src="<?php echo base_url() ?>asset/bower_components/maprouting/dist/leaflet-routing-machine.js"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php if($user['jenis_id']==1){
          echo base_url('admin');
        }else{
          echo base_url('lahan');
        }
    ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>VCO</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><h5 class="mt-4">VCO KAB. Padang Pariaman</h5></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url('asset/dist/img/avatar.png')?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $user['nama'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url('asset/dist/img/avatar.png')?>" class="img-circle" alt="User Image">
                <p>
                  <?= $user['nama'] ?>
                  <small>Member since Agustus. 2019</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url('akun') ?>" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url('Authentikasi/logout')?>" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
      </div>
    </nav>
  </header>

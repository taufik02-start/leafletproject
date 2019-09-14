<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Akses Diblokir</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/style.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- jQuery 3 -->
  <script src="<?php echo base_url() ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>asset/bower_components/jquery/dist/jquery.json-2.4.min.js"></script>
  <!-- Lefflet -->
</head>
<!-- Content Wrapper. Contains page content -->

<body>
  <!-- Main content -->
  <section class="content">
    <div class="error-page">
      <h2 class="headline text-yellow"> 403</h2>
      <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Akses Diblokir</h3>
        <p>
          Maaf anda tidak memiliki hak untuk mengakses halaman tersebut
          <a href="<?php echo base_url('akun') ?>" class="btn btn-primary mt-3">Dashboard</a>
        </p>
      </div>
      <!-- /.error-content -->
    </div>
  </section>
  <!-- /.content -->
</body>
</html>

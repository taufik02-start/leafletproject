<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?= $this->session->flashdata('pesan')?>
    <p class="login-box-msg" style="font-size:25px">Login</p>
    <form method="post" action="<?= base_url('authentikasi') ?>">
      <div class="form-group has-feedback">
        <input type="type" class="form-control" placeholder="Email" id="email" name="email" value = "<?=set_value('email')?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?= form_error('email','<small class="text-danger pl-3">','</small>');?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?= form_error('password','<small class="text-danger pl-3">','</small>');?>
      </div>
	     <div class="social-auth-links text-center">
       <input type="submit" class="btn btn-block btn-primary btn-flat" value="Login">
    </div>
    </form>
    <!-- /.social-auth-links -->
    <a href="<?=base_url('authentikasi/lupaPassword') ?>">Lupa password</a><br>
    Masih belum punya akun? <a href="<?=base_url('authentikasi/register') ?>" class="text-center">Buat akun</a>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
